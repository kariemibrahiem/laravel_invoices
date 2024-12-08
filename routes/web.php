<?php

use App\Http\Controllers\AdminController_1;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoicesAttachmentController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\InvoicesDetailsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SectionController;
use App\Mail\AddInvoiceMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Mail\addInvoiceMail;






Route::get("/" , function(){
    return view("auth.login");
});

Auth::routes();
Auth::routes(["register"=>false]);
Route::get("/home" , [HomeController::class , "index"])->name("home");

// the invoices page routes
Route::resource("invoices" , InvoicesController::class);
// delete the invoice 
Route::get("invoicesDelete" , [InvoicesController::class , "destroy"])->name("invoicesDelete.destroy");
// delete the invoice 
Route::get("invoicesForceDelete" , [InvoicesController::class , "forceDelete"])->name("invoicesForceDelete.forceDelete");
// delete the invoice 
Route::get("invoicesEdit/{id}" , [InvoicesController::class , "edit"])->name("invoicesEdit.edit");
// the update if invoices
Route::post("invoices_update" , [InvoicesController::class , "update"])->name("invoices_update.update");
// udpate status in the invoices
Route::get("update_status/{id}" , [InvoicesController::class , "udpate_status"])->name("update_status"); 
// udpate the payment method in the invoices
Route::post("update_payment" , [InvoicesController::class , "update_payment"])->name("update_payment.update");
// the paid invoices 
Route::get("paidInvoices" , [InvoicesController::class , "paidInvoices"])->name("paidInvoices");
// the paid invoices 
Route::get("unpaidInvoices" , [InvoicesController::class , "unpaidInvoices"])->name("unpaidInvoices");

// the archive invoices 
Route::get("archiveInvoices" , [InvoicesController::class , "archiveInvoices"])->name("archiveInvoices.archive");

// the unArchive invoices 
Route::get("unArchiveInvoices" , [InvoicesController::class , "unArchiveInvoices"])->name("unArchiveInvoices.unArchive");

// the print invoices 
Route::get("printInvoice/{id}" , [InvoicesController::class , "printInvoice"])->name("printInvoice");

//show the details of invoice 
Route::get("invoices_details/{id}" , [InvoicesDetailsController::class , "invoices_details"])->name("invoices_details");

// update the attachment in the invoices 
Route::post("attachment" , [InvoicesAttachmentController::class , "store"])->name("attachment_store");

Route::view("checkMail" , "mails.mail");


Route::resource("sections" , SectionController::class);

Route::resource("/products" , ProductController::class);
// 
Route::get("/section/{id}" , [InvoicesController::class , "GetProduct"]);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get("/{page}" , [AdminController_1::class , "index"])->middleware("auth");
