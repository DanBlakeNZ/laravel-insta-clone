<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image; //http://image.intervention.io/

class PostsController extends Controller // Note when creating a directory in views, convention is to call the directory after the controller name eg 'posts'
{
	// Adding this will protect the post routes - the user has to be logged into be able to post, otherwise redirected to login.
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function index()
	{
		$users = auth()->user()->following()->pluck('profiles.user_id'); // The id's of the users the currently logged in user is following.
		
		// Return posts where a (post's) user_id is in the list of $users. Latest lists them newest to oldest.
		$posts = Post::whereIn('user_id', $users)->latest()->paginate(5); //Paginate - include the number of records we want per-page

		return view('posts/index', compact('posts'));
	}

	public function create()
	{
		return view('posts/create');
	}

	public function store()
	{
		// Perform validation on a submitted form
		// List of validation rules that can be used: https://laravel.com/docs/5.1/validation#available-validation-rules
		// request() contains the request values.
		$data = request()->validate([
			'caption' => 'required',
			'image' => ['required', 'image'], //Multiple rules - ensure the uploaded file is an image https://laravel.com/docs/5.1/validation#rule-image
		]);

		$imagePath = request('image')->store('uploads', 'public');
		// First param is where you want to store the image. (app/public/storage/uploads)
		// Second param is what driver you want to use to store the file eg s3.
		// NOTE: Don't forget to run php artisan storage:link to ensure there is a public link to the storage folder

		//NOTE: The Image import at the top of the page
		$image = Image::make(public_path("storage/{$imagePath}"))->fit(1200, 1200);
		$image->save(); // Overrides the image/file saved/stored in the previous step.

		auth()->user()->posts()->create([
			'caption' => $data['caption'],
			'image' => $imagePath,
		]);
		// The above is required because in the create_posts_table.php migration there is $table->unsignedBigInteger('user_id').
		// The ID of the authenticated user is not in the request, but the ID is required.
		// 1. Get the authenticated user.
		// 2. On that user call their posts (User.posts() located in User.php).
		// 3. Create a new post - Laravel will add the required user ID behind the scenes for us.


		return redirect('/profile/' .  auth()->user()->id);
	}

	// Route Model Binding
	// If the route key attribute being passed (post) & the variable ($post) has the same name,
	// then you can type hint (\App\Post) the model and Laravel will try to fetch the resource for us automatically.
	// this also automatically includes findOrFail for us.
	public function show(\App\Post $post)
	{
		return view('posts/show', compact('post')); // Compact is the same as doing ['post' => $post]
	}
}

