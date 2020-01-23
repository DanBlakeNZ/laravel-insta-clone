<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class FollowsController extends Controller
{
    // Adding this will protect the post routes - the user has to be logged into be able to post, otherwise redirected to login.
	public function __construct()
	{
		$this->middleware('auth');
    }

    public function store(User $user)
    {
       return auth()->user()->following()->toggle($user->profile); //$user is the user being passed in.
    }
}
