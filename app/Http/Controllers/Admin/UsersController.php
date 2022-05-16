<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Gate;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function __construct() 
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index')->with('users', $users);
    }

    
        /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        
        // we can use 'denies' or 'allows'
        if(Gate::denies('edit-users')){
            return redirect(route('admin.users.index'));
        }
        
        $roles = Role::all();

        return view('admin.users.edit')->with([
            'user' => $user,
            'roles' => $roles
        ]);
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
        $user->roles()->sync($request->roles);
        // roles() method (from User.php model) - belongsToMany relationship
        // we call array of roles - sync() method - allows us to pass an array of ids that we want to link
        // from the users to roles
        // $request-> roles - get the array 'roles' from the request, sync will attach it to the $user
        
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'Korisnik je ažuriran!') ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if(Gate::denies('delete-users')){
            return redirect(route('admin.users.index'));
        }
        
        // Detach all roles from the given user
        $user->roles()->detach();
        // Delete the user
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Korisnik je izbrisan!');
    }
}
