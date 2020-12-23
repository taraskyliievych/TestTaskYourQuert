<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parser extends Model
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
        'items_in_file',
        'changes_in_casts',
        'changes_in_countries',
        'changes_in_genres',
        'changes_in_languages',
        'changes_in_movies',
        'changes_in_new_movies',
        'changes_in_old_movies'
    ];
}
