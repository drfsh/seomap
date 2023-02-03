<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $appends = ['code', 'status_fa', 'paid', 'error'];
    protected $guarded = [];

    public function getCodeAttribute()
    {
        return 3500 + $this->id;
    }

    public function getErrorAttribute()
    {
        $i = $this->invoices;
        $c = false;
        foreach ($i as $item)
            if ($item->status != 1) {
                $c = true;
                break;
            }
        return $c;
    }

    public function getCreatedAtAttribute($value)
    {
        $value = Carbon::parse($value)->timezone('Asia/Tehran');
        return Verta($value)->format('H:i Y/m/d');
    }

    public function getStatusFaAttribute()
    {
        return match ($this->status) {
            0 => 'درحال بررسی',
            1 => 'دریافت اطلاعات',
            2 => 'بررسی اطلاعات',
            3 => 'درحال انجام',
            4 => 'ارسال دمو پروژه',
            5 => 'تحویل پروژه',
            -1 => 'لغو',
            default => '',
        };
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function attr_new()
    {
        return $this->hasOne(ProjectNewAttr::class);
    }

    public function attrs()
    {
        return $this->hasMany(Attribute::class);
    }

    public function access()
    {
        return $this->hasOne(Access::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class)->orderBy('created_at', 'desc');
    }

    public function ticket()
    {
        return $this->hasOne(Ticket::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function getPaidAttribute()
    {
        $invoices = Invoice::where([['project_id', $this->id], ['status', 1]])->get();
        $p = 0;
        foreach ($invoices as $invoice) {
            $p += $invoice->amount;
        }
        return $p;
    }
}
