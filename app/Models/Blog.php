<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Blog extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getThumbnailAttribute($value)
    {
        return $value?Storage::url($value):null;
    }

    //Time min ago format
    protected $dates = ['created_at'];

    // ---Read Count--- //
    public function incrementReadCount() {
        $this->view_count++;
        return $this->save();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function category()
    {
        return $this->belongsTo(BlogCategory::class,'category_id');
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
    static public function scopeFilter($query){
        $query->when(request()->category ?? null, function ($query, $category) {
            $query->whereHas('category',function($query) use($category){
                $query->where('slug',$category);
            });
        });

    }

    public function getCreatedAtAttribute($value){
        return Carbon::parse($value)->format('Y-m-d H:i:s');
    }

    
}
