<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\Jalalian;

class Project extends Model
{
    use HasFactory;

    protected $appends = ['code', 'status_fa'];
    protected $guarded = [];

    public function getCodeAttribute()
    {
        return 50000 + $this->id;
    }

    public function getCreatedAtAttribute($value)
    {
        return Jalalian::fromCarbon(Carbon::parse($value))->format('Y/m/d H:i');
    }

    public function getStatusFaAttribute()
    {
        switch ($this->status) {
            case 0:
                return 'درحال برسی';
            case 1:
                return 'در انتضار پرداخت';
            case 2:
                return 'درحال انجام';
            case 3:
                return 'درانتضار پرداخت نهایی';
            case 4:
                return 'اتمام';
            case 5:
                return 'لغو';
            default:
                return '';
        }
    }

}
