<?php

namespace App\Http\Controllers;

use App\Models\role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;

class UserRegisterConroller extends Controller
{
    public function showUsers(){
        $allUsersRoles = role::all();
        $allUsers = User::all();


        return view('admin-panel.pages.stu_registration',compact('allUsersRoles','allUsers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->roleId,
        ]);

       

        return redirect()->back()->with('success','user registered successfully');
    }

    public function delete($id){
        $userDetailDelete = User::findOrFail($id);
        $userDetailDelete->delete();
        return redirect()->back()->with('success','Data delete succesfully');
    }
    public function update(Request $request){
        // dd($request);
        $userRecord = User::findOrFail($request->UserId); 
        // dd($userRecord);

        $request->validate([
            'email' => ['required|string|lowercase|email|max:255', 
        Rule::unique('users')->ignore($userRecord->userId)],

        ]);


        $userRecord->name = $request->userName; 
        $userRecord->email = $request->UserEmail;  
        $userRecord->role_id = $request->roleId;  

        $userRecord->save(); 

       

    
        return redirect()->back()->with('success','data updated successfully');
    }
}
