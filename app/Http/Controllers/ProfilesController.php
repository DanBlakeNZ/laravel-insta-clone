<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfilesController extends Controller
{
	public function index(\App\User $user)
	{
		return view('profiles/index', compact('user'));// 'user' is the variable name being passed into home.blade.php. Could also be done using compact('user')
	}


	public function edit(\App\User $user)
	{
		return view('profiles/edit', compact('user'));
	}

	public function update(\App\User $user)
	{
		$data = request()->validate([
			'title' => 'required',
			'description' => 'required',
			'url' => 'url',
			'image'=> '',
		]);

		// $user->profile->update($data); << Works but is insecure as we are getting all user values from the request
		auth()->user()->profile->update($data); // Secure as getting values from authenticated user.

		return redirect("/profile/{$user->id}");
	}
}
