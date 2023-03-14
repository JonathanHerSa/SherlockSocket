<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cv extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo',
        'status',
    ];

    public function Tarima(): HasMany
    {
        return $this->hasMany(Tarima::class);
    }
}
