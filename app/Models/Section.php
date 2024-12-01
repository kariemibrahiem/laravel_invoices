<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $fillable = ["section_name" , "description" , "created_by"];
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function Invoices(){
        return $this->hasMany(invoices::class);
    }
}
