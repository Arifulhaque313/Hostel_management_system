<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $guarded = [
        'id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];


    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function getImageAttribute($value)
    {
        return $value?Storage::url($value):null;
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function hasPermission($permission): bool
    {
        return $this->role->permissions()->where('slug', $permission)->first() ? true : false;
    }
    public function bookings(){
        return $this->hasMany(Booking::class);
    }
    public function merchant(){
        return $this->hasOne(Merchant::class);
    }
    public function pickAndDropBookings(){
        return $this->hasMany(PickAndDropBooking::class);
    }
    static public function scopeFilter($query){
        $query->when(request()->search ?? null, function ($query, $search) {
            $query->where('name', 'LIKE', "%$search%")
            ->orWhere('email', 'LIKE', "%$search%")
            ->orWhere('phone', 'LIKE', "%$search%")
            ;
        })->when(request()->role ?? null, function ($query, $role) {
            $query->whereHas('role',function($query) use($role){
                $query->where('slug',$role);
            });
        });

    }
}
