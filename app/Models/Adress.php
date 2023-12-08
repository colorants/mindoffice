<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adress extends Model
{
    use HasFactory;


    protected $fillable = [
        'id',
        'type',
        'street',
        'housenumber',
        'zipcode',
        'city',
        'country_id',
        'company_id',

    ];

    public function Company(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

public function Country(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->BelongsTo(Country::class);
    }



}
