<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SectionController extends Controller
{
    public function __construct(){
        $this->middleware("auth");
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sections = Section::all();
        return view("sections.section" , compact("sections"));
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
        $request->validate([
            "section_name"=>"required|min:8|unique:sections,section_name",
            "description"=>"required|min:5"
        ]);
        try{
            Section::create([
                "section_name" => $request->section_name,
                "description" => $request->description,
                "created_by" => Auth::user()->name
            ]);
            session()->flash("success" , "the section has created successfully");
        }catch(Exception $e){
            session()->flash("field" , "the store field". $e);
        }
        return redirect("/sections");
    }

    /**
     * Display the specified resource.
     */
    public function show(section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(section $section)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
       try{
        $request->validate([
            "section_name"=>"unique:sections,section_name",
        ]);
            $section = Section::find($request->id);
            $section->update([
                "section_name"=>$request->section_name,
                "description"=>$request->description,
            ]);
            session()->flash("success" , "the section updated successfully");
        }catch(Exception $e){
            session()->flash("field" , "the section updated field" . $e);
       }
       return redirect("/sections");

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try{
            Section::destroy($request->id);
            session()->flash("success" , "the destroy successfully"  );
        }catch(Exception $e){
            session()->flash("field" , "the destroy field"  . $e);
        }
        return redirect("/sections");
    }
}
