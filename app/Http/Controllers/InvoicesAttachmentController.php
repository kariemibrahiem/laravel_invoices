<?php

namespace App\Http\Controllers;

use App\Models\InvoicesAttachment;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\addInvoiceMail;
class InvoicesAttachmentController extends Controller
{
    public function __construct(){
        $this->middleware("auth");
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        // return $request;
    
       try{
                $image = $request->file("picture");
                $file_name = $image->getClientOriginalName();

                // InvoicesAttachment::create([
                //     "file_name" => $file_name,
                //     "invoice_number" =>$request->invoice_number,
                //     "invoice_id" =>$request->invoice_id,
                //     "Created_by" => Auth::user()->name,
                // ]);
                $invoice_attach = new InvoicesAttachment();
                $invoice_attach->file_name = $file_name;
                $invoice_attach->invoice_number = $request->invoice_number;
                $invoice_attach->invoice_id = $request->invoice_id;
                $invoice_attach->Created_by =  Auth::user()->name;


                $request->picture->move(public_path("attachments/".$request->invoice_number ),$file_name);
                $msg = "adding new attachment";
                Mail::to("kariemibrahiem110@gmail.com")->send(new addInvoiceMail($request->invoice_id , Auth::user()->name , $msg));

                session()->flash("success" , "the attachment is add successfully");
       }catch(Exception $e){
        session()->flash("field" , "the attachment is add field");
            // return "$e";
            return redirect('/invoices');
       }
        return redirect('/invoices');
    }

    /**
     * Display the specified resource.
     */
    public function show(InvoicesAttachment $invoicesAttachment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InvoicesAttachment $invoicesAttachment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, InvoicesAttachment $invoicesAttachment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InvoicesAttachment $invoicesAttachment)
    {
        //
    }
}
