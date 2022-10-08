<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    use HasFactory;
    protected $guarded = [
        'id'
    ];
    
    public function imageable()
    {
        return $this->morphTo();
    }

    public function getPathAttribute($value){
        return Storage::url($value);
    }
}
