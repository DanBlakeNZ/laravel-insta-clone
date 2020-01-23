<?php
// Profile Model

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $guarded = []; // Disables Mass Assignment (because we are performing validation already)

    public function profileImage()
    {
        $imagePath = ($this->image) ? $this->image : "profile/II4Tx2K06Lk2siErZqhJJDvytbfHw2IMZniDumCO.png";
        return $imagePath;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function followers()
    {
        return $this->belongsToMany(User::class);
    }
}
