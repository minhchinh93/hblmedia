<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class taskJob extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function User()
    {
        return $this->belongsTo(User::class, 'User_id', 'id');
    }
}
