<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActorSubmission extends Model
{
    protected $fillable = [
        'email',
        'actor_description',
        'first_name',
        'last_name',
        'address',
        'height',
        'weight',
        'gender',
        'age',
        'parsed_at',
    ];
}
