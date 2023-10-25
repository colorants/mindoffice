<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_video extends Model
{
    use HasFactory;


    protected $fillable = [
        'id',
        'user_id',
        'video_id',
    ];

}
