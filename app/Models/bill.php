<?php

namespace App\Models;

use App\Models\bill_detaill;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bill extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function bill_detail()
    {
        return $this->hasMany(bill_detaill::class, 'id_bill', 'id');
    }

    public function bill()
    {
        return $this->belongsTo(User::class, 'id_User', 'id');
    }
}
