<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $table = 'countries';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'updated_at',
        'name',
        'is_usa',
        'is_europe'
    ];

     public function movies()
     {
         return $this->belongsToMany(Movie::class, 'cast_movie');
     }
}
