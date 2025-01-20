<?php

namespace App\Http\Controllers;

use App\Models\role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
  
   public function roleSubmit(Request $req){
        // dd($req->all());
        $role = new role();
        $role->role_name = $req->roleName;
        $role->discriptions = $req->roleDescription;
        $role->save();
        return redirect()->back()->with('success','Data submit successfully');
    }
    public function show(){
        $allRoles = role::all();
        // dd($allRoles);
        return view('admin-panel.pages.roles',compact('allRoles'));
    }
    public function destroy($uuid){
        $roleDelete = role::findOrFail($uuid);
        $roleDelete->delete();
        return redirect()->back()->with('success','Data delete succesfully');
        // dd($roleDelete);
    }
    public function edit(Request $uuid) {
        $editRole = Role::findOrFail($uuid->roleId);
        // dd($editRole);
        return view('admin-panel.pages.editroles',compact('editRole')); 
    }
    
    public function update(Request $request) {
        // dd($request);
        $role = Role::findOrFail($request->roleId); 
        $role->role_name = $request->roleName; 
        $role->discriptions = $request->discriptions; 
        $role->update(); 
    
        return redirect()->route('roles');
    }
    
    
}
