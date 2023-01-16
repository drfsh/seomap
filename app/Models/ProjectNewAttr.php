<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectNewAttr extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $with = ['type','platform'];

    public function type(){
        return $this->belongsTo(Type::class,'type_id');
    }

    public function platform(){
        return $this->belongsTo(Platform::class,'platform_id');
    }
}
