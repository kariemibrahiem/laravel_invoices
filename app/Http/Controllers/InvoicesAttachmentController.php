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
    
       try{
                $image = $request->file("picture");
                $file_name = $image->getClientOriginalName();

                InvoicesAttachment::create([
                    "file_name" => $file_name,
                    "invoice_number" =>$request->invoice_number,
                    "invoice_id" =>$request->invoice_id,
                    "Created_by" => Auth::user()->name,
                ]);

                $request->picture->move(public_path("attachments/".$request->invoice_number ),$file_name);
       }catch(Exception $e){
            return "$e";
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
