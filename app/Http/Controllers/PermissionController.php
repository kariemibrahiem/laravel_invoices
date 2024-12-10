<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function __construct(){
        $this->middleware("auth");
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions = Permission::all();
        $count = Permission::count();
        return view("users.permission" , compact("count" , "permissions"));
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
            Permission::create([
                'name' =>$request->permission,
            ]);
            session()->flash("status" , "success to create");
       }catch(Exception $e){
            session()->flash("status" , "field to create");
       }
        return  redirect("permissions");
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
        // return $request;
        Permission::destroy($request->id);
        return redirect("/permissions");
    }
    public function destroy(string $id)
    {
        //
    }
}
