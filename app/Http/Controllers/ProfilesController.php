<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfilesController extends Controller
{
	// Called from app > http > web.php
	public function index($user)
	{
		return view('home'); // Referring to resources/views/home.blade.php
	}
}
