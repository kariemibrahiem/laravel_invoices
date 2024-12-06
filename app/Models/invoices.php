<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class invoices extends Model
{
    use Notifiable;
    use SoftDeletes;

    // protected $fillable = ["invoices_number", "value_status" , "status" , "note" , "Total" , "Value_VAT" , "Rate_VAT" , "Discount" , "Amount_Commission" , "Amount_collection" , "product" , "Section" , "Due_date" , "invoice_Date" ] ;
    
    Protected $guarded = [];
    // the relation between invoice and sectino 
    public function section(){
        return $this->belongsTo(Section::class);
    }

    // the relation between the invocie and details
    public function invoice_details(){
        return $this->hasOne(InvoicesDetails::class);
    }
}
