@extends('admin.layout')

@section('content')
<div class="mb-6">
    <div class="px-8 mb-6 flex justify-between items-center">
        <h1 class="text-2xl font-bold">{{ $title }}</h1>
    </div>
    <div class="flex flex-col w-full py-8 rounded-lg shadow-xl items-center justify-center mb-8">
        <div class="px-8 w-full mb-3">
            <div class="relative mb-4 flex w-full flex-wrap items-stretch">
                <input id="advanced-search-input" type="search"
                    class="relative m-0 -mr-0.5 block w-[1px] min-w-0 flex-auto rounded-l border border-solid border-neutral-300 bg-transparent bg-clip-padding px-3 py-[0.25rem] text-base font-normal leading-[1.6] text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-neutral-700 focus:shadow-[inset_0_0_0_1px_rgb(59,113,202)] focus:outline-none"
                    placeholder="Search" aria-label="Search" aria-describedby="button-addon1" />

                <button
                    class="relative z-[2] flex items-center rounded-r bg-primary px-6 py-2.5 text-xs font-medium uppercase leading-tight text-white shadow-md transition duration-150 ease-in-out hover:bg-primary-700 hover:shadow-lg focus:bg-primary-700 focus:shadow-lg focus:outline-none"
                    type="button" id="advanced-search-button">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="h-5 w-5" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        </div>
        <div id="datatable" class="w-full px-5 py-5"></div>
    </div>
</div>

@endsection

@section('script')
<script>
    function display(dataBookings) {
        const customDatatable = document.getElementById("datatable");
        if (customDatatable) {
            customDatatable.innerHTML = '';

            const rows = dataBookings.map((item, index) => {
                const date = new Date(item.appointment_date);
                const formattedDate = date.toLocaleDateString('id-ID', {
                    day: 'numeric',
                    month: 'long',
                    year: 'numeric'
                });

                return {
                    no: index + 1,
                    name: item.name,
                    email: item.email,
                    phone: item.phone,
                    vehicle_model: item.vehicle_model,
                    service_type: item.service_type,
                    appointment_date: formattedDate,
                    notes: item.notes,
                };
            });

            const instance = new te.Datatable(
                customDatatable,
                {
                    columns: [
                        { label: "No.", field: "no" },
                        { label: "Name", field: "name", sort: true },
                        { label: "Email", field: "email" },
                        { label: "Phone", field: "phone" },
                        { label: "Vehicle Model", field: "vehicle_model" },
                        { label: "Service Type", field: "service_type" },
                        { label: "Appointment Date", field: "appointment_date", sort: true },
                        { label: "Notes", field: "notes" },
                    ],
                    rows: rows,
                },
                {
                    hover: true,
                    striped: true
                }
            );


            const advancedSearchInput = document.getElementById('advanced-search-input');

            const search = (value) => {
                let [phrase, columns] = value.split(" in:").map((str) => str.trim());

                if (columns) {
                    columns = columns.split(",").map((str) => str.toLowerCase().trim());
                }

                instance.search(phrase, columns);
            };

            document
                .getElementById("advanced-search-button")
                .addEventListener("click", (e) => {
                    search(advancedSearchInput.value);
                });

            advancedSearchInput.addEventListener("keydown", (e) => {
                search(e.target.value);
            });
        }
    }

    display(@json($bookings));
</script>
@endsection
