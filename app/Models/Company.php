<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;


    protected $fillable = [
        'id',
        'name',
        'kvk',
        'btw',
        'country_id',

    ];

    public function Adress(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->HasOne(Adress::class);
    }

    public function Country(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->BelongsTo(Country::class);
    }

    public function User(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(User::class);
    }



}
