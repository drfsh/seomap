<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\Jalalian;

class Message extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['user'];

    public function getUpdatedAtAttribute($value)
    {
        $date = Jalalian::fromCarbon(Carbon::parse($value));
        return [$date->format('Y/m/d '), $date->format('H:i')];
    }

    public function getUserAttribute()
    {
        return User::find($this->user_id);
    }
}
