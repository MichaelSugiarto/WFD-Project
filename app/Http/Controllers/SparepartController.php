<?php

namespace App\Http\Controllers;
use App\Models\Sparepart;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class SparepartController extends Controller
{
    public function view()
    {
        $data = [
            'spareparts' => Sparepart::get(),
            'title' => 'Sparepart',
        ];
        return view('admin.allSparepart', $data);
    }

    public function storeSparepart(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'stock' => 'required|integer|min:1',
        ]);

        $name = $request->name;
        $stock = $request->stock;

        $sparepart = Sparepart::where('name', $name)->first();

        if ($sparepart) {
            $sparepart->stock += $stock;
            $sparepart->save();
        } else {
            Sparepart::create([
                'id' => Str::uuid()->toString(),
                'name' => $name,
                'stock' => $stock,
            ]);
        }

        return redirect()->back()->with('success', 'Sparepart saved successfully!');
    }
}
