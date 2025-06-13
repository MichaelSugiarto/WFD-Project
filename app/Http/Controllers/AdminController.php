<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.dashboard')->with(['title' => 'Dashboard']);
    }

    public function allAdmins()
    {
        $admins = Admin::with(['role'])->get();
        $roles = Role::get();
        return view('admin.allAdmins')->with([
            'title' => 'List Admin',
            'admins' => $admins,
            'roles' => $roles,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required',
            'email' => 'required|email',
        ]);

        $name = $request->name;
        $email = $request->email;
        $role = $request->role;

        Admin::create([
            'name' => $name,
            'email' => $email,
            'role_id' => $role,
        ]);

        return redirect()->back()->with('success', 'Admin added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        //
    }
}
