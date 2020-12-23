<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'updated_at',
        'name',
    ];

    public function movies()
    {
        return $this->belongsToMany(Movie::class, 'language_movie');
    }
}
