<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Morilog\Jalali\Jalalian;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'mobile',
        'password',
    ];

    protected $appends = ['admin','code'];

    public function getProfileAttribute($value){
        if ($value)
            return $value;
        else
            return '/images/icons/user.svg';
    }

    public function getCodeAttribute()
    {
        return 5000 + $this->id;
    }

    public function getAdminAttribute(){
        return $this->isPermission('admin');
    }

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class)->orderBy('created_at','desc')->with('service');
    }

    public function isPermission($value): bool
    {
        $p = Permission::where([['value',$value],['user_id',$this->id]])->first();
        return !is_null($p);
    }

    public function getCreatedAtAttribute($value)
    {
        return Jalalian::fromCarbon(Carbon::parse($value))->format('Y/m/d');
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
