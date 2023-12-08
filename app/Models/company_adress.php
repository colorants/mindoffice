<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class company_adress extends Model
{
    use HasFactory;


    protected $fillable = [
        'id',
        'company_id',
        'adress_id',
    ];

}
