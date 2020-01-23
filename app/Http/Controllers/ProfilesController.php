<?php

namespace App\Http\Controllers;

use App\User;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;

class ProfilesController extends Controller
{
	public function index(User $user)
	{

		$follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;

		// Note the importing of Cache at the top.
		$postCount = Cache::remember( // note you can also use rememberForever which doesn't expire
			'count.posts.' . $user->id, // Cache key/name is concatenating count.posts with user id.
			now()->addSeconds(30), // time to store/cache value
			function() use ($user){ // If its not there, run this
				return  $user->posts->count();
			});


			$followersCount = Cache::remember(
				'count.followers.' . $user->id,
				now()->addSeconds(30),
				function () use ($user) {
						return $user->profile->followers->count();
				});

		$followingCount = Cache::remember(
				'count.following.' . $user->id,
				now()->addSeconds(30),
				function () use ($user) {
						return $user->following->count();
				});

		return view('profiles/index', compact('user', 'follows', 'postCount', 'followersCount', 'followingCount'));// The variable names being passed into home.blade.php.
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

			$imageArray = ['image' => $imagePath];
		}

		// $user->profile->update($data); << Works but is insecure as we are getting all user values from the request
		// Below is more cecure as getting values from authenticated user.
		auth()->user()->profile->update(array_merge(
			$data,
			$imageArray ?? [] // This will override the 'image' value stored in $data.
		));

		return redirect("/profile/{$user->id}");
	}
}
