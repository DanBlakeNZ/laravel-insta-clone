<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = []; // This turns off Laravel's automatic validation - because we are validation in the controllers.

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
