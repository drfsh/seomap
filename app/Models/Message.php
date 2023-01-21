<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['user'];

    public function getUpdatedAtAttribute($value)
    {
        $value = Carbon::parse($value)->timezone('Asia/Tehran');
        $date = Verta($value);
        return [$date->format('Y/m/d '), $date->format('H:i')];
    }

    public function getUserAttribute()
    {
        return User::find($this->user_id);
    }
}
