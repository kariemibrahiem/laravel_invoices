<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoicesDetails extends Model
{
    protected $guarded = [];

    public function invoice(){
        return $this->belongsTo(invoices::class);
    }
}
