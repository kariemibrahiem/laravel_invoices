<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class invoices extends Model
{
    // protected $fillable = ["invoices_number", "value_status" , "status" , "note" , "Total" , "Value_VAT" , "Rate_VAT" , "Discount" , "Amount_Commission" , "Amount_collection" , "product" , "Section" , "Due_date" , "invoice_Date" ] ;
    use SoftDeletes;
    Protected $guarded = [];
    public function section(){
        return $this->belongsTo(Section::class);
    }

    public function invoice_details(){
        return $this->hasOne(InvoicesDetails::class);
    }
}
