<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;

#Add access control
class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return view('roles.list', compact('roles', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    #Redirect if user not logged in
    public function create()
    {
        // return view('roles.create');
        if (Auth::check())
        {
          return view('roles.create');
        }
        else
        {
          return redirect('/login');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'role' => 'required|unique:roles'
        ], [
            'role.unique' => 'That role already exists.'
        ]);


        $role = new Role([
            'role' => $request->post('role')
        ]);

        $role->save();
        return redirect('/roles')->with('success', "{$role['role']} created.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        return view('roles.view', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        // return view('roles.edit',compact('role'));
        if (Auth::check())
        {
          return view('roles.edit', compact('role'));
        }
        else
        {
          return redirect('/login');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'role' => 'required|unique:roles'
        ],[
            'role.unique' => 'That role already exists.'
        ]);

        $role = Role::find($id);
        $role->role = $request->get('role');

        $role->update();

        return redirect('/roles')->with('success', 'Role renamed to ' . $role->role);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        // $role->delete();
        // return redirect('/roles')->with('success', 'Role deleted.');
        if (Auth::check())
        {
          $role->delete();
          return redirect('/roles')->with('success', 'Role deleted.');
        }
        else
        {
          return redirect('/login');
        }
    }
}
