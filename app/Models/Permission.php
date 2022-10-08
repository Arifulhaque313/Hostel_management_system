<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Permission extends Model
{
    use HasFactory;

    public static function getAllPermissions()
    {
        return Cache::rememberForever('permissions.all', function() {
            return self::all();
        });
    }

    /**
     * Flush the cache
     */
    public static function flushCache()
    {
        Cache::forget('permissions.all');
    }

    public function module()
    {
        return $this->belongsTo(Module::class);
    }
    
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
