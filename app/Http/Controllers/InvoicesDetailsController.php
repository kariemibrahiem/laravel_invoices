<?php

namespace App\Http\Controllers;

use App\Models\invoices;
use App\Models\InvoicesAttachment;
use App\Models\InvoicesDetails;
use Illuminate\Http\Request;

class InvoicesDetailsController extends Controller
{
    public function __construct(){
        $this->middleware("auth");
    }
    /**
     * Display a listing of the resource.
     */
    // function to display the invoices details
    public function invoices_details($id)
    {
        $invoices =   invoices::where("id" , $id)->get();
        $invoice_details =   InvoicesDetails::where("invoice_id" , "=" , $id)->get();
        $invoice_attachment =   InvoicesAttachment::where("invoice_id" , "=" , $id)->get();

        return view("details.details" , compact("invoices" , "invoice_details" , "invoice_attachment"));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(InvoicesDetails $invoicesDetails)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InvoicesDetails $invoicesDetails)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, InvoicesDetails $invoicesDetails)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InvoicesDetails $invoicesDetails)
    {
        //
    }
}
