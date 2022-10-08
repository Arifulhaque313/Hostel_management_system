<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Module extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public static function getWithPermissions()
    {
        return Cache::rememberForever('permissions.getWithPermissions', function () {
            return self::with('permissions')->get();
        });
    }

    static public function scopeStatus($query){
        return $query->where('status',1);
    }

    public function permissions()
    {
        return $this->hasMany(Permission::class);
    }
}

