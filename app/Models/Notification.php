<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\Jalalian;

class Notification extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['user'];
    public function getCreatedAtAttribute($value)
    {
        return Jalalian::fromCarbon(Carbon::parse($value))->format('H:i Y/m/d');
    }

    public function getUserAttribute()
    {
        $user = User::find($this->user_id);
        if ($user)
        return $user->name;
        else return 'مدیریت';
    }


}
