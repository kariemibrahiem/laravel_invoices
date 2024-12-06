<?php

namespace App\Http\Controllers;

use App\Models\InvoicesAttachment;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoicesAttachmentController extends Controller
{
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
        // add attachment to an exst invoice
    
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

                session()->flash("success" , "the attachment added successfully");
       }catch(Exception $e){
                session()->flash("field" , "the attachment added field");
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
