<?php

namespace App\Http\Controllers;

use App\Mail\addInvoiceMail;
use App\Models\invoices;
use App\Models\InvoicesAttachment;
use App\Models\InvoicesDetails;
use App\Models\Product;
use App\Models\Section;
use App\Models\User;
use App\Notifications\invocieNotify;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;

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
    // the paid invoice index to dispaly
    public function paidInvoices(){
        $invoices = invoices::where("value_status" ,1)->get();
        return view("invoices.paidInvoices" , compact("invoices"));
    }
    // the unpaid invoice index to dispaly
    public function unpaidInvoices(){
        $invoices = invoices::where("value_status" ,0)->get();
        return view("invoices.unpaidInvoices" , compact("invoices"));
    }
    // the archiveing and unarchiving part 
    public function archiveInvoices(){
        $invoices =  invoices::onlyTrashed()->get();
        return view("invoices.archiveInvoices" , compact("invoices"));
    }
    public function unArchiveInvoices(Request $request){
        invoices::withTrashed()->where("id" , $request->id)->restore();
        return redirect("/invoices");
    }

    // the print invoice section 
    public function printInvoice($id){
        $invoice = invoices::where("id" , $id)->first();
        return view("invoices.printInvoice" , compact("invoice"));
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
     
        try{

              
       
        $invoice = new invoices();
        $invoice->invoice_number = Auth::user()->id.$request->section.$request->invoice_number;
        $invoice->invoice_date = $request->invoice_date;
        $invoice->due_date = $request->due_date;
        $invoice->product = $request->product;
        $invoice->section_id = $request->section;
        $invoice->Amount_collection = $request->Amount_collection;
        $invoice->Amount_commision = $request->Amount_commission;
        $invoice->discoint = $request->discount;
        $invoice->rate_vate = $request->rate_vate;
        $invoice->value_vate = $request->value_vate;
        $invoice->total = $request->total;
        $invoice->status = "غير مدفوعه";
        $invoice->value_status = 0;
        $invoice->note = $request->note;
        $invoice->user = Auth::user()->name;
        $invoice->save();

        $invoice_id = invoices::latest()->first()->id;
     
            //  create the details seciton 
            $details = new InvoicesDetails();
            $details->invoice_number = Auth::user()->id.$request->section.$request->invoice_number;
            $details->invoice_id = $invoice_id;
            $details->product = $request->product;
            $details->Section = $request->section;
            $details->status = 'غير مدفوعه';
            $details->value_status = 2;
            $details->note = $request->note;
            $details->user = Auth::user()->name;
            $details->save();

            if($request->has("picture")){
                
            $image = $request->file("picture");
            $file_name = $image->getClientOriginalName();


            $attachment = new InvoicesAttachment();
            $attachment->invoice_number =  Auth::user()->id.$request->section.$request->invoice_number;
            $attachment->invoice_id = $invoice_id;
            $attachment->file_name = $file_name;
            $attachment->Created_by = Auth::user()->name;
            $attachment->save();

            $request->picture->move(public_path("attachments/".Auth::user()->id.$request->section.$request->invoice_number) , $file_name);


            }

            
            session()->flash("success" , "the invoice added successfully");
                

        }catch(Exception $e){
            session()->flash("fail" , "the createtion field");
        }

        return redirect("/invoices")->with("success");

    }

    // udpate the invoice status

    public function udpate_status($id){
        
            $invoice = invoices::find($id);
            $sections = Section::all();
            return view("invoices.updateStatus" , compact("invoice" , "sections"));

       

    }
    public function update_payment(Request $request){
        // return $request;
        $invoice = invoices::find($request->id);
        $invoice->value_status = $request->payment;
        $invoice->status = $request->payment== 0 ? "غير مدفوعه" : "مدفوعه";
        $invoice->save();
        InvoicesDetails::create([
            "invoice_number"=>Auth::user()->id.$invoice->section_id.$invoice->invoice_number,
            "invoice_id" =>$request->id,
            "product"=>$invoice->product,
            "Section"=>$invoice->section_id,
            "status"=> $request->payment== 0 ? "غير مدفوعه" : "مدفوعه",
            "value_status"=>$request->payment,
            "note"=>$invoice->note,
            "user"=>Auth::user()->name,
            "Payment_Date"=>$request->Payment_Date
        ]);
        
        
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
            session()->flash("success" , "the invoice edited successfully");
            return redirect("/invoices");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        invoices::destroy( $request->id);
   
        session()->flash("success" , "the invoice deleted successfully");
    
        return redirect("/invoices");

    }
    public function forceDelete(Request $request)
    {
        
        $invoice = invoices::withTrashed()->where("id" , $request->id)->get();


        $attachment = InvoicesAttachment::where("invoice_id" , $request->id)->first();
        if(!empty($attachment->invoice_number)){
            File::deleteDirectory(public_path("attachments/".$attachment->invoice_number));
        }
            
        
        invoices::withTrashed()->where("id" , $request->id)->forceDelete();


        session()->flash("success" , "the invoice deleted successfully");
        return redirect("/invoices");

    }

    public function GetProduct($id){
        $products = DB::table("products")->where("section_id" , $id)->pluck("product_name" , "id");
        return json_encode($products);
    }
}
