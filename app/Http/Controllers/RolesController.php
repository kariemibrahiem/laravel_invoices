<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesController extends Controller
{
    public function __construct(){
        $this->middleware("auth");
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        $permissions = Permission::all();
        $count = Role::count();
        $rolePermissions = DB::table('role_has_permissions')->get();
        return view("users.roles" , compact("roles" , "count" , "permissions" , "rolePermissions"));
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
        Role::create([
            "name"=>$request->role,
        ]);
        
        $role =  Role::latest()->first();
        // $role->givePermissionTo($permissions->name);
        $role->syncPermissions($request->permission);

        return  redirect("roles");
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
    public function destroying(Request $request){
        Role::destroy($request->id);
        return redirect("/roles");
    }
    public function destroy(string $id)
    {
        //
    }
}
