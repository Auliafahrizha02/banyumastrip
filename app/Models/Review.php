<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'wisata_id',
        'user_id',
        'rating',
        'comment',
    ];

    /**
     * Review belongs to a wisata.
     */
    public function wisata()
    {
        return $this->belongsTo(Wisata::class);
    }

    /**
     * Review belongs to a user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
