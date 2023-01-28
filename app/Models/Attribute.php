<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['created_at_fa','updated_at_fa'];
    public function getCreatedAtFaAttribute()
    {
//        $value = Carbon::parse($this->created_at)->timezone('Asia/Tehran');
        $value = $this->created_at;
        return Verta($value)->format('H:i Y/m/d');
    }
    public function getUpdatedAtFaAttribute()
    {
//        $value = Carbon::parse($this->created_at)->timezone('Asia/Tehran');
        $value = $this->updated_at;
        return Verta($value)->format('H:i Y/m/d');
    }

    public function project(){
        return $this->belongsTo(Project::class);
    }
}
