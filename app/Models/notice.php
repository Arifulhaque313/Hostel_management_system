<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class notice extends Model
{
    use HasFactory;
    protected $guarded = [
        'id'
    ];

     public function getCreatedAtAttribute($value){
        return Carbon::parse($value)->format('Y-m-d');
    }
}
