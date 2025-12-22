<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * Mass assignable attributes.
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
    ];

    /**
     * A category has many wisatas.
     */
    public function wisatas()
    {
        return $this->hasMany(Wisata::class);
    }
}
