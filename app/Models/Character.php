<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id', //se deja el id en los campos fillable para que coincida con el del API de rick y morty
        'name',
        'status',
        'species',
        'type',
        'gender',
        'origin',
        'location',
        'image',
    ];
}
