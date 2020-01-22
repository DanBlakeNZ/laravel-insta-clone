<?php

namespace App\Http\Controllers;

use Intervention\Image\Facades\Image; 
use Illuminate\Http\Request;
use App\User;

class ProfilesController extends Controller
{
	public function index(User $user)
	{
		return view('profiles/index', compact('user'));// 'user' is the variable name being passed into home.blade.php. Could also be done using compact('user')
	}


	public function edit(User $user)
	{
		$this->authorize('update', $user->profile); //Authorizing an update via ProfilePolicy.php

		return view('profiles/edit', compact('user'));
	}

	public function update(User $user)
	{
		$this->authorize('update', $user->profile);

		$data = request()->validate([
			'title' => 'required',
			'description' => 'required',
			'url' => 'url',
			'image'=> '',
		]);

		if(request('image')){
			$imagePath = request('image')->store('profile', 'public');
			$image = Image::make(public_path("storage/{$imagePath}"))->fit(1000, 1000); 	//NOTE: The Image import at the top of the page
			$image->save();
		}

		// $user->profile->update($data); << Works but is insecure as we are getting all user values from the request
		// Below is more cecure as getting values from authenticated user.
		auth()->user()->profile->update(array_merge(
			$data,
			['image' => $imagePath] // This will override the 'image' value stored in $data.
		));

		return redirect("/profile/{$user->id}");
	}
}
