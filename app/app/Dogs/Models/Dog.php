<?php

namespace App\Dogs\Models;

use Illuminate\Database\Eloquent\Model;

class Dog extends Model
{
    protected $fillable = [
        'external_id',
        'name',
        'temperament',
        'weight_metric',
        'weight_imperial',
        'life_span',
    ];
}