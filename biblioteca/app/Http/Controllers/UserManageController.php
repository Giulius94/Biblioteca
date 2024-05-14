<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Reservation;

use Illuminate\Http\Request;

class UserManageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      
        if (auth()->user()->isAdmin == 1) {
            
            $users = User::all(); 
            return view('usersManagePage', ['users' => $users]);
        } else {
           
            return redirect('/books'); 
        }
    }
    
            
        
        //return view('usersmanagepage' , ['users' => $users = User::all()]);
       
   

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {    if (auth()->user()->isAdmin == 1) {return view('userAddPage');}
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = new User();
        $user['name'] = $request->name;
        $user['email'] = $request->email;
        $user['password'] = $request->password;
        $user['isAdmin'] = $request->isAdmin;
        if ($request->isAdmin == 1) {
        $user['email_verified_at'] = now();
        $user->save();}

        return redirect('/users');

    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {    

        $reservetion = User::with('reservations.book' )->findOrFail($user->id) ;
       
        //return $reservetion;
        return view('detailUserPage', ['user' => $reservetion]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('usersEditPage', ['user' => $user]);
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $user['name'] = $request->name;
        $user['email'] = $request->email;
        $user['password'] = $request->password;
        $user['isAdmin'] = $request->isAdmin;
        if ($request->isAdmin == 1) {
            $user['email_verified_at'] = now();}

        $user->update   ();
        return redirect('/users');


       return $request;
       // return redirect('/users');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {   
        $user->delete();

        return redirect('/users');
    }
}
