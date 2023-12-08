<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'code'
    ];

    public function Adress(): \Illuminate\Database\Eloquent\Relations\belongsTo
    {
        return $this->belongsTo(Adress::class);
    }
}
