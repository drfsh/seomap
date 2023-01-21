<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\Jalalian;

class Ticket extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $appends = ['body', 'code', 'status_fa'];

    public function getBodyAttribute()
    {
        $t = Message::where('ticket_id', $this->id)->latest()->first();
        if ($t)
            return $t->text;
        else return'';
    }

    public function getCodeAttribute()
    {
        return 1200 + $this->id;
    }

    public function getStatusFaAttribute()
    {
        return match ($this->status) {
            0 => 'در انتظار پاسخ',
            1 => 'درحال برسی',
            2 => 'پاسخ داده شده',
            3 => 'بسته شده',
            default => '',
        };
    }


    public function getUpdatedAtAttribute($value)
    {
        $value = Carbon::parse($value)->timezone('Asia/Tehran');
        $date = Verta($value);
        return [$date->format('Y/m/d '), $date->format('H:i')];
    }
}
