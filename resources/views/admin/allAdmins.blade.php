@extends('admin.layout')

@section('content')
<div class="mb-6">
    <div class="px-8 mb-6 flex justify-between items-center">
        <h1 class="text-2xl font-bold">{{ $title }}</h1>
        <!-- Add Admin button to open modal -->
        <button id="addAdminBtn" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
            Add Admin +
        </button>
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

<!-- Modal for adding Admin -->
<div id="addAdminModal" class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-[1100]">
    <div class="bg-white rounded-lg shadow-lg p-6 w-96 relative">
        <h2 class="text-lg font-bold mb-4">Add Admin</h2>
        <form method="POST" action="{{ route('admin.storeAdmin') }}">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}"
                    class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm p-2 focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50"
                    required>
            </div>
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}"
                    class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm p-2 focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50"
                    required>
            </div>
            <div class="mb-4">
                <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                <select name="role" id="role" value="{{ old('role') }}"
                    class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm p-2 focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50"
                    required>
                    <option value="">Select any role</option>
                    @foreach ($roles as $r)
                        <option value="{{ $r->id }}">{{ $r->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex justify-end space-x-2">
                <button type="button" id="closeModalBtn"
                    class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">Close</button>
                <button type="submit"
                    class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Add</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal for editing Admin -->
<div id="editAdminModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-[1100]">
    <div class="bg-white rounded-lg shadow-lg p-6 w-96 relative">
        <h2 class="text-lg font-bold mb-4">Add Admin</h2>
        <form method="POST" action="{{ route('admin.updateAdmin') }}">
            @csrf
            <input id="id_edit" name="id" type="text" hidden>
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" id="name_edit"
                    class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm p-2 focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50"
                    required>
            </div>
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email_edit"
                    class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm p-2 focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50"
                    required>
            </div>
            <div class="mb-4">
                <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                <select name="role" id="role_edit"
                    class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm p-2 focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50"
                    required>
                    <option value="">Select any role</option>
                    @foreach ($roles as $r)
                        <option value="{{ $r->id }}">{{ $r->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex justify-end space-x-2">
                <button type="button" id="closeEditModalBtn"
                    class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">Close</button>
                <button type="submit"
                    class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Edit</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('script')
<script>
    function display(dataAdmins) {
        const customDatatable = document.getElementById("datatable");
        if (customDatatable) {
            customDatatable.innerHTML = '';

            const rows = dataAdmins.map((item, index) => {
                return {
                    no: index + 1,
                    name: item.name,
                    email: item.email,
                    role: item.role.name,
                    action: `
                        <div class="w-full flex flex-row gap-2 justify-center">
                            <button class="editAdminBtn py-2 px-4 bg-yellow-400 rounded-md" data-id="${item.id}" data-name="${item.name}" data-email="${item.email}" data-role="${item.role.id}">Edit</button>
                            <button class="py-2 px-4 bg-red-400 rounded-md" data-id="${item.id}" onclick="deleteAdmin(this)">Delete</button>
                        </div>
                    `,
                };
            });

            const instance = new te.Datatable(
                customDatatable,
                {
                    columns: [
                        { label: "No.", field: "no" },
                        { label: "Name", field: "name", sort: true },
                        { label: "Email", field: "email", sort: true },
                        { label: "Role", field: "role", sort: true },
                        { label: "Action", field: "action" },
                    ],
                    rows: rows,
                },
                { hover: true, stripped: true }
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

    // Parse data from Blade to JSON for display
    display(@json($admins));

    // Modal open/close handling
    document.getElementById('addAdminBtn').addEventListener('click', () => {
        document.getElementById('addAdminModal').classList.remove('hidden');
    });

    document.getElementById('closeModalBtn').addEventListener('click', () => {
        document.getElementById('addAdminModal').classList.add('hidden');
    });

    document.querySelectorAll('.editAdminBtn').forEach(button => {
        button.addEventListener('click', () => {
            document.getElementById('editAdminModal').classList.remove('hidden');
            document.getElementById('id_edit').value = button.dataset.id;
            document.getElementById('name_edit').value = button.dataset.name;
            document.getElementById('email_edit').value = button.dataset.email;
            document.getElementById('role_edit').value = button.dataset.role;
        });
    });

    document.getElementById('closeEditModalBtn').addEventListener('click', () => {
        document.getElementById('editAdminModal').classList.add('hidden');
        document.getElementById('id_edit').value = "";
        document.getElementById('name_edit').value = "";
        document.getElementById('email_edit').value = "";
        document.getElementById('role_edit').value = "";
    });

    function deleteAdmin(element){
        Swal.fire({
            title: "Are you sure want to delete this member?",
            text: "This action can't be revert",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Confirm",
            customClass: {
                confirmButton: 'green',
                cancelButton: 'red',
            },
            didOpen: () => {
                document.querySelector('.swal2-container').style.zIndex = "9999";
            }
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'POST',
                    url: "{{ route('admin.deleteAdmin') }}",
                    data: JSON.stringify({
                        id: element.dataset.id,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    }),
                    processData: false,
                    contentType: 'application/json',
                    cache: false,
                    success: async function(response) {
                        if (response.success) {
                            await Swal.fire({
                                title: "Success!",
                                text: response.message,
                                icon: "success",
                                confirmButtonText: "OK",
                                didOpen: () => {
                                    document.querySelector('.swal2-container').style
                                        .zIndex = "9999";
                                }
                            });
                            window.location.reload();
                        } else {
                            await Swal.fire({
                                icon: "error",
                                title: "Oops...",
                                text: response.message,
                                didOpen: () => {
                                    document.querySelector('.swal2-container').style
                                        .zIndex = "9999";
                                }
                            });
                        }
                    },
                    error: async function(xhr, textStatus, errorThrown) {
                        if (xhr.status === 422) {
                            const errors = xhr.responseJSON.errors;
                            let errorMessage = '';
                            for (let key in errors) {
                                errorMessage += errors[key].join(' ') +
                                    '\n'; // Collect all error messages
                            }
                            await Swal.fire({
                                title: 'Deletion Error!',
                                text: errorMessage,
                                icon: 'error',
                                confirmButtonText: 'OK',
                                didOpen: () => {
                                    document.querySelector('.swal2-container').style
                                        .zIndex = "9999";
                                }
                            });
                        } else {
                            await Swal.fire({
                                title: 'Oops!',
                                text: 'Something went wrong: ' + xhr.statusText,
                                icon: 'error',
                                confirmButtonText: 'OK',
                                didOpen: () => {
                                    document.querySelector('.swal2-container').style
                                        .zIndex = "9999";
                                }
                            });
                        }
                    }
                })
            } else {
                // User canceled the submission
                Swal.fire({
                    title: "Cancelled!",
                    text: "Your data was not submitted.",
                    icon: "info",
                    confirmButtonText: "OK",
                    didOpen: () => {
                        document.querySelector('.swal2-container').style.zIndex = "9999";
                    }
                });
            }
        });
    }
</script>
@endsection
