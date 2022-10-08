<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];
 
    public function getCreatedAtAttribute($date)
    {
        //    return Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
        $date= Carbon::parse($date);
        return $date->format('Y-m-d H:i');
    }
 
    static function scopeFilter($query)
    {
        $query->when(request()->search ?? null, function ($query, $search) {
            $query->where("name", 'LIKE', '%' . $search . '%')
            ->orWhere("email", 'LIKE', '%' . $search . '%')
            ->orWhere("location", 'LIKE', '%' . $search . '%')
            ->orWhere("subject", 'LIKE', '%' . $search . '%');
        });
    }
}
