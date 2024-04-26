<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oder_detail extends Model
{
    use HasFactory;
    protected $fillable = [
        'Number_Items',
        'Sale_Date',
        'Order_Total',
        'Date_Shipped',
        'oder_sku',
        'saller',
    ];

    public function ProductPngDetails()
    {
        return $this->belongsTo(ProductPngDetails::class, 'oder_sku', 'id');

    }
}
