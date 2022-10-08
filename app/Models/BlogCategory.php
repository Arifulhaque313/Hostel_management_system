<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
    ];

    use HasFactory;
    public function blogs()
    {
        return $this->hasMany(Blog::class,'category_id');
    }

    public function getCreatedAtAttribute($value){
        return Carbon::parse($value)->format('Y-m-d H:i:s A');
    }
}
