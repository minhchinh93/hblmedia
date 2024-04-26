<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cornerstone extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function product()
    {
        return $this->belongsToMany(Product::class, 'product_cornerstone', 'id_product', 'cornerstones_id');
    }
}
