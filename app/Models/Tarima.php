<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tarima extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo',
        'direccion',
        'status',
        'cvs_id',
    ];

    public function Cv(): BelongsTo
    {
        return $this->belongsTo(Tarima::class);
    }
}
