<?php

namespace App\Models;

use App\Http\Controllers\VideoController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;


    protected $fillable = [
        'id',
        'title',

    ];

    public static function find(mixed $id)
    {
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(VideoController::class);
    }

    public function videos(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Video::class);
    }
}
