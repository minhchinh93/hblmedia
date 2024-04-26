<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class checkDowload extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function checkDowload()
    {
        return $this->belongsTo(User::class, 'User_id', 'id');
    }
}
