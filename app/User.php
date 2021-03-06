<?php
// User Model
// This model represents a single row in the database - a single User in the database.

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;

use App\Mail\NewUserWelcomeMail;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'username', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        //When a user gets created, we also want to create a profile for them.
        static::created(function ($user){
            $user->profile()->create([
                'title' => $user->username,
            ]);

            Mail::to($user->email)->send(new NewUserWelcomeMail()); // Send user a welcome email. Note imports at the top.
        });
    }

    public function profile()
    {
        return $this->hasOne(Profile::class); // app/Profile - it already exists in the App namespace defined at the top of this file.
    }

    public function posts()
    {
        return $this->hasMany(Post::class)->orderBy('created_at', 'DESC'); // reverse the order saved on DB (newest post first)
    }

    public function following()
    {
        return $this->belongsToMany(Profile::class);
    }
}
