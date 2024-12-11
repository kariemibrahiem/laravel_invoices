<?php

use App\Http\Controllers\AdminController_1;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoicesAttachmentController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\InvoicesDetailsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\UsersPermissionController;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Mail\AddInvoiceMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\PermissionController;






Route::get("/" , function(){
    return view("auth.login");
});

Auth::routes();
Auth::routes(["register"=>false]);
Route::get("/home" , [HomeController::class , "index"])->name("home");

// super admin permissions
Route::middleware(["role:super_admin"])->group(function(){

        // delete the invoice 
        Route::get("invoicesDelete" , [InvoicesController::class , "destroy"])->name("invoicesDelete.destroy");
        // delete the invoice 
        Route::get("invoicesForceDelete" , [InvoicesController::class , "forceDelete"])->name("invoicesForceDelete.forceDelete");
        Route::get('users.delete', [UsersPermissionController::class , "deletion"])->name("user.deletion");
        Route::get('rolesDelete', [RolesController::class , "destroying"])->name("roles.delete");
        Route::get('permissionsDelete', [PermissionController::class , "destroying"])->name("permissions.delete");
});





Route::view("checkMail" , "mails.mail");

// admin permissions****************************************************************
Route::middleware(["role:admin|super_admin"])->group(function () {

        Route::resource('users', UsersPermissionController::class);
        Route::get('users.update_status/{id}', [UsersPermissionController::class , "update_status"])->name("userStatus");
        Route::resource('roles', RolesController::class);
        Route::resource('permissions', PermissionController::class);
        // the archive invoices 
        Route::get("archiveInvoices" , [InvoicesController::class , "archiveInvoices"])->name("archiveInvoices.archive");
        // the unArchive invoices 
        Route::get("unArchiveInvoices" , [InvoicesController::class , "unArchiveInvoices"])->name("unArchiveInvoices.unArchive");
        // delete the invoice 
        Route::get("invoicesEdit/{id}" , [InvoicesController::class , "edit"])->name("invoicesEdit.edit");
        // the update if invoices
        Route::post("invoices_update" , [InvoicesController::class , "update"])->name("invoices_update.update");
        // udpate status in the invoices
        Route::get("update_status/{id}" , [InvoicesController::class , "udpate_status"])->name("update_status"); 
        // udpate the payment method in the invoices
        Route::post("update_payment" , [InvoicesController::class , "update_payment"])->name("update_payment.update");
});



// user permissions*********************************************************
// the invoices page routes
Route::resource("invoices" , InvoicesController::class);
Route::resource("/products" , ProductController::class);
Route::resource("sections" , SectionController::class);
Route::get("/section/{id}" , [InvoicesController::class , "GetProduct"]);
// update the attachment in the invoices 
Route::post("attachment" , [InvoicesAttachmentController::class , "store"])->name("attachment_store");
//show the details of invoice 
Route::get("invoices_details/{id}" , [InvoicesDetailsController::class , "invoices_details"])->name("invoices_details");
// the print invoices 
Route::get("printInvoice/{id}" , [InvoicesController::class , "printInvoice"])->name("printInvoice");
// the paid invoices 
Route::get("paidInvoices" , [InvoicesController::class , "paidInvoices"])->name("paidInvoices");
// the paid invoices 
Route::get("unpaidInvoices" , [InvoicesController::class , "unpaidInvoices"])->name("unpaidInvoices");

// payment form 
Route::get("invoices/paymentForm/{id}" , [InvoicesController::class , "paymentForm"])->name("invoices.paymentForm");
// payment method 
Route::post('/invoice/{invoiceId}/pay', [InvoicesController::class, 'processPayment'])->name('invoices.processPayment');







Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get("/{page}" , [AdminController_1::class , "index"])->middleware("auth");
