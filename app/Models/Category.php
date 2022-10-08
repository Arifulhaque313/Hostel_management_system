<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'image'
    ];

    use HasFactory;

    public function subcategories()
    {
        return $this->hasMany(SubCategory::class,'category_id');
    }
    public function products()
    {
        return $this->hasMany(Product::class,'category_id');
    }
    public function getImageAttribute($value){
        return Storage::url($value);
    }

    public function getCreatedAtAttribute($value){
        return Carbon::parse($value)->format('Y-m-d H:i:s A');
    }

    
}
