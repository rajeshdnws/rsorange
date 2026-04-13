<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
protected $fillable = [
    'type',
    'slug',
    'title',
    'description',
    'image',
    'is_active',
];}