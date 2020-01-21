<?php

namespace App\Http\Controllers;


use App\User; // Here we are referencing User located in User.php - is referenced below as User.
use Illuminate\Http\Request;

class ProfilesController extends Controller
{
	// Called from app > http > web.php
	public function index($user)
	{
		$user = User::findOrFail($user); //findOrFail (as apposed to just find() will go to a 404 error page rather than throw errors)

		// 'home' is referring resources/views/profiles/index.blade.php
		return view('profiles/index',[
			'user' => $user, // 'user' is the variable name being passed into home.blade.php
		]);
	}
}
