<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = []; // Disables Mass Assignment. This turns off Laravel's automatic validation - because we are performing validation in the controller.

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
