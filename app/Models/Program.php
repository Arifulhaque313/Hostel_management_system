<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Program extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function getCreatedAtAttribute($value){
        return Carbon::parse($value)->format('Y-m-d H:i:s A');
    }

    public function getImageAttribute($value){
        return Storage::url($value);
    }

    public function getExpireDateAttribute($value){
        $actual = Carbon::parse($value)->floatDiffInDays(Carbon::today());
        if( Carbon::today()->format("Y-m-d") <= Carbon::parse($value)->format("Y-m-d") ){
            return Carbon::parse($value)->format('d M, Y');
        }
        return 'expired';
    }
}
