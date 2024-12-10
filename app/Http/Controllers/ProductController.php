<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Section;
use Exception;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(){
        $this->middleware("auth");
    }
    /**
     * Display a listing of the resource.
     */
    
    public function index()
    {
        $products = Product::all();
        $sections = Section::all();
        return view("products.product" , compact("products" , "sections"));
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
    // create new product based on the section id
    public function store(Request $request)
    {
        $product = new Product();
       try{
            $request->validate([
                "product_name"=>"required|min:8"
            ]);
            $product->product_name = $request->product_name;
            $product->description = $request->description;
            $product->section_id = $request->section_id;
            $product->save();

            session()->flash("success" , "the product created successfully");
       }catch(Exception $e){
            session()->flash("field" , "the product creation field" );
       }
       return redirect("/products");
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    // update the product content
    public function update(Request $request)
    {
        try{
            $product = Product::find($request->id);
            $product->product_name = $request->product_name;
            $product->description = $request->description;
            $product->section_id = $request->section_id;
            $product->save();
            session()->flash("success" , "the product udapted successfully");
        }catch(Exception $e){
            session()->flash("field" , "the product udapted field");
        }
        return redirect("/products");
    }

    /**
     * Remove the specified resource from storage.
     */
    // delete the product
    public function destroy(Request $request)
    {
        try{
            Product::destroy($request->id);
            session()->flash("success" , "the product deleted  successfully");
        }catch(Exception $e){
            session()->flash("field" , "the product deletion successfully");
        }
        return redirect("products");
    }
}
