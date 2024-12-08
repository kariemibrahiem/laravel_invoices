<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Product extends Model
{
    protected $fillabe = ["product_name" , "description" , "section_id"];
    
    // the relation between the product and section
    public function section()
    {
        return $this->belongsTo(Section::class);
    }
}
