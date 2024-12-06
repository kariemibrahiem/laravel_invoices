<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $fillable = ["section_name" , "description" , "created_by"];
    // relation between the product and sections
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    
    // relation between the invoices and sections
    public function Invoices(){
        return $this->hasMany(invoices::class);
    }
}
