<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon;

class Role extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function getUpdatedAtAttribute($date)
    {
        $date=Carbon\Carbon::parse($date);
        return $date->format('Y-m-d H:i');
    }

    static public function scopeFilter($query){
        $query->when(request()->search ?? null, function ($query, $search) {
            $query->where('name', 'LIKE', "%$search%")
            ->orWhere('slug', 'LIKE', "%$search%");
        });

    }
}
