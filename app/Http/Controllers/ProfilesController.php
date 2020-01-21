<?php

namespace App\Http\Controllers;


use App\User; // Here we are referencing User located in User.php - is referenced below as User.
use Illuminate\Http\Request;

class ProfilesController extends Controller
{
	// Called from app > http > web.php
	public function index($user)
	{
		$user = User::find($user);

		// 'home' is referring resources/views/home.blade.php
		return view('home',[
			'user' => $user, // 'user' is the variable name being passed into home.blade.php
		]);
	}
}
