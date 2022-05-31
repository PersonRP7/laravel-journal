<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;


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
        #Add foreign keys to posts
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
        // $roles = Role::all();
        // return view('users.create', compact('roles', 'roles'));
        if (Auth::check())
        {
          $roles = Role::all();
          return view('users.create', compact('roles', 'roles'));
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
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:users|max:255',
            'password' => 'required|confirmed|min:6',
            'email' => 'required|unique:users',
            // 'role' => 'required'
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
                // 'role' => $request->post('role'),
            ]);

            $user->save();
            Auth::login($user);
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

        // Admin can edit everyone's pages
        // User can only edit his own page

        $roles = Role::all();

        $current_user = auth()->user();

        return view('users.edit', compact('user', 'roles', 'current_user'));
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
        $validator = Validator::make($request->all(), [
            'name' => 'nullable|unique:users|max:255',
            'password' => 'nullable|confirmed|min:6',
            'email' => 'nullable|unique:users',
            'role' => 'nullable'
          ]);

          if ($validator->fails()) {
            return redirect(route('users.edit', [$user->id]))
                     ->withErrors($validator)
                     ->withInput();
          }else {
              $user = User::find($user->id);
              if ($request->filled('name'))
              { $user->name = $request->name; }

              if ($request->filled('password'))
              { $user->password = Hash::make($request->password); }

              if ($request->filled('email'))
              { $user->email = $request->email; }

              if ($request->filled('role'))
              { $user->role = $request->role; }

              $user->update();

            return redirect('/users')->with('success', "{$user['name']} updated.");
          }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if ($user->allowDelete(Auth::id()))
        {
          $user->delete();
          return redirect('/users')->with('success', "{$user['name']} deleted.");
        }
        else
        {
          return redirect('/users')->with('error', 'Cannot delete.');
        }
    }
}
