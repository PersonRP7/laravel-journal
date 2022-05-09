<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $users = User::all();
        return view('users.list', compact('users', 'users'));
    }

    public function my_profile(Request $request)
    {
        // $user = $request->user;
        $user = Auth::user();
        return view('users.my_profile', compact('user', 'user'));
    }

    public function manage_users(Request $request)
    {
        $users = User::all();
        return view('users.manage_users', compact('users', 'users'));
    }

    public function see_all_users()
    {
        $users = User::all();
        // return view('journal.see_all_users', compact('users', 'users'));
        return view('users.see_all_users', compact('users', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // use the isEmpty property on the collection
        $roles = Role::all();
        return view('users.create', compact('roles', 'roles'));
    }
   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:users|max:255',
            'password' => 'required|confirmed|min:6',
            'email' => 'required|unique:users',
            'role' => 'required'
          ]);

          if ($validator->fails()) {
            return redirect('users/create')
                     ->withErrors($validator)
                     ->withInput();
          }else {
            $user = new User([
                'name' => $request->post('name'),
                'email' => $request->post('email'),
                'password' => $request->post('password'),
                'role' => $request->post('role'),
            ]);

            $user->save();
            return redirect('/users')->with('success', "{$user['name']} created.");
          }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.view', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    // Components in subfolders are referenced using a period (dot) . and not a hyphen -.
    {
        // Admin form: Edit all fields
        // User form: edit all fields except role
        // Check user role. If admin, use admin form.
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
