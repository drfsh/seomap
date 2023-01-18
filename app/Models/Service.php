<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function types(): HasMany
    {
        return $this->hasMany(Type::class);
    }

    public function sTypes(): array
    {
        return $this->toSelect($this->types()->get());
    }

    public function platforms(): HasMany
    {
        return $this->hasMany(Platform::class);
    }
    public function plans(): HasMany
    {
        return $this->hasMany(Plan::class);
    }

    public function sPlatforms(): array
    {
        return $this->toSelect($this->platforms()->get());
    }

    private function toSelect($items): array
    {
        $res = [];
        foreach ($items as $item) {
            $res[$item->id] = $item->name;
        }
        return $res;
    }
}
