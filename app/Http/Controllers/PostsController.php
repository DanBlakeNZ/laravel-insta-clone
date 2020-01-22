<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostsController extends Controller // Note when creating a directory in views, convention is to call the directory after the controller name eg 'posts'
{
	public function create()
	{
		return view('posts/create');
	}

	public function store()
	{
		// Perform validation on a submitted form
		// List of validation rules that can be used: https://laravel.com/docs/5.1/validation#available-validation-rules
		$data = request()->validate([
			'caption' => 'required',
			'image' => ['required', 'image'], //Multiple rules - ensure the uploaded file is an image https://laravel.com/docs/5.1/validation#rule-image
		]);

		auth()->user()->posts()->create($data);
		// The above is required because in the create_posts_table.php migration there is $table->unsignedBigInteger('user_id').
		// The ID of the authenticated user is not in the request, but the ID is required.
		// 1. Get the authenticated user.
		// 2. On that user call theix posts (User.posts() located in User.php).
		// 3. Create a new post - Laravel will add the required user ID behind the scenes for us.


		dd(request()->all());
	}
}
