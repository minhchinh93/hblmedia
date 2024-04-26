<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class product extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function User()
    {
        return $this->belongsTo(User::class, 'User_id', 'id');

    }
    public function size()
    {
        return $this->belongsTo(size::class, 'size_id', 'id');

    }
    public function type_product()
    {
        return $this->belongsTo(type_product::class, 'id_type', 'id');

    }

    public function product_details()
    {
        return $this->hasMany(ProductDetails::class, 'product_id', 'id');
    }
    public function ProductPngDetails()
    {
        return $this->hasMany(ProductPngDetails::class, 'product_id', 'id');
    }
    public function mocups()
    {
        return $this->hasMany(mocupProduct::class, 'product_id', 'id');
    }
    public function cornerstones()
    {
        return $this->belongsToMany(cornerstone::class, 'product_cornerstone', 'id_product', 'cornerstones_id');
    }

}
