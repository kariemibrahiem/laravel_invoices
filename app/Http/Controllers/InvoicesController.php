<?php

namespace App\Http\Controllers;

use App\Models\invoices;
use App\Models\InvoicesAttachment;
use App\Models\InvoicesDetails;
use App\Models\Product;
use App\Models\Section;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoices = invoices::all();
        return view("invoices.invoices" , compact("invoices"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sections = Section::all();
        return view("invoices.add_invoices" , compact("sections"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
        
        // create in the inovices table 
        try{

            invoices::create([
                "invoice_number"=>Auth::user()->id.$request->section.$request->invoice_number,
                "invoice_date"=>$request->invoice_date,
                "due_date"=>$request->due_date,
                "product"=>$request->product,
                "section_id"=>$request->section,
                "Amount_collection"=>$request->Amount_collection,
                "Amount_commision"=>$request->Amount_commission,
                "discount"=>$request->discount,
                "rate_vate"=>$request->rate_vate,
                "value_vate"=>$request->value_vate,
                "total"=>$request->total,
                "status"=>"غير مدفوعه",
                "value_status"=>2, 
                "note"=>$request->note,
                "user"=>Auth::user()->name,
            ]);

            // create in the invoices_details table 
            $invoice_id = invoices::latest()->first()->id;
            InvoicesDetails::create([
                "invoice_number"=>Auth::user()->id.$request->section.$request->invoice_number,
                "invoice_id" =>$invoice_id,
                "product"=>$request->product,
                "Section"=>$request->section,
                "status"=>"غير مدفوعه",
                "value_status"=>2,
                "note"=>$request->note,
                "user"=>Auth::user()->name,
                "Payment_Date"=>"cread",
            ]);
            
            // create in the attachment table 
            
            if($request->hasFile("picture")){
                
                $image = $request->file("picture");
                $file_name = $image->getClientOriginalName();
                // $path = $image->store("public" , "disk"),
                
                InvoicesAttachment::create([
                    
                    "invoice_number" => $request->invoice_number,
                    "file_name" => $file_name,
                    "invoice_id" => $invoice_id,
                    "created_by" => Auth::user()->name,
                    
                ]);

                // move the file to the server
                $request->picture->move(public_path("attachments/".$request->invoice_number ),$file_name);
                
                session()->flash("success" , "the invoice added successfully");
            }
            }catch(Exception $e){
                session()->flash("fail" , "the invoice field to add");
            };
                



        return redirect("/invoices")->with("success");

    }

    // udpate the invoice status

    public function udpate_status($id){
        
            $invoice = invoices::find($id);

            $value = !$invoice->value_status;
             $invoice->value_status =  $value;
            $invoice->save();
            session()->flash("success" , "the status udpated successfully");

            return redirect("/invoices");

    }

    /**
     * Display the specified resource.
     */
    public function show(invoices $invoices)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id )
    {
        $invoice = invoices::where("id" , $id)->first();
        $sections = Section::all();
        return view("invoices.editInvoices" , compact("invoice" , "sections"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        invoices::where("id" , $request->id)->update([
                "due_date"=>$request->due_date,
                "product"=>$request->product,
                "section_id"=>$request->section,
                "Amount_collection"=>$request->Amount_collection,
                "Amount_commision"=>$request->Amount_commission,
                "discount"=>$request->discount,
                "rate_vate"=>$request->rate_vate,
                "value_vate"=>$request->value_vate,
                "total"=>$request->total,
                "status"=>"غير مدفوعه",
                "value_status"=>2, 
                "note"=>$request->note,
                "user"=>Auth::user()->name,
            ]);
            return redirect("/invoices");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
       invoices::destroy($id);
       InvoicesDetails::where("invoice_id" , $id)->delete();
       InvoicesAttachment::where("invoice_id" , $id)->delete();
       return redirect("/invoices");

    }

    public function GetProduct($id){
        $products = DB::table("products")->where("section_id" , $id)->pluck("product_name" , "id");
        return json_encode($products);
    }
}
