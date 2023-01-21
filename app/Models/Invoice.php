<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['status_fa','code'];

    public function getStatusFaAttribute(){
        return match ($this->status) {
            0 => 'در انتظار پرداخت',
            1 => 'پرداخت شده',
            2 => 'خطا',
            default => '',
        };
    }
    public function getCodeAttribute()
    {
        return 5000 + $this->id;
    }
    public function getCreatedAtAttribute($value)
    {
        $value = Carbon::parse($value)->timezone('Asia/Tehran');
        return Verta($value)->format('Y/m/d H:i');
    }
    public function getPayDateAttribute($value)
    {
        if ($value)
        {
            $value = Carbon::parse($value)->timezone('Asia/Tehran');
            return Verta($value)->format('Y/m/d H:i');
        }
        else return null;
    }
    public function project(){
        return $this->belongsTo(Project::class,'project_id');
    }
}
