<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class company_user extends Model
{
    use HasFactory;


    protected $fillable = [
        'id',
        'company_id',
        'user_id',
    ];

}
