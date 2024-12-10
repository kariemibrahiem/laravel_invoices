<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class UsersPermissionController extends Controller
{
    public function __construct(){
        $this->middleware("auth");
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        $count = USer::count();
        $roles = Role::all();
        return view("users.users" , compact("users" , "count" , "roles"));
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
       try{
            User::create([
                "name" =>$request->user_name,
                "email"=>$request->email,
                "password"=>Hash::make($request->pass), // check
            ]);
            
            // assign the role to the user 
                $user = User::latest()->first();
                // $user->assignRole($request->role);
                $user->syncRoles($request->role); // assign multiple roles to the user
                
            session()->flash("success" , "user created success");
       }catch(Exception $e){
            session()->flash("field" , "user created field");
       }
        return  redirect("users");
        
    }
    public function update_status(Request $request){
        $user = User::where("id" , $request->id)->first();
        $status = $user->status;
        $user->status = !$status;
        $user->save();
        return  redirect("users");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deletion(Request $request)
    {
        User::destroy($request->id);
        return redirect("users");
    }
    
}
