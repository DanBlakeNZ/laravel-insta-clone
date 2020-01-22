<?php
// Profile Model

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $guarded = []; // Disables Mass Assignment (because we are performing validation already)

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
