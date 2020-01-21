<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostsController extends Controller // Note when creating a directory in views, convention is to call the directory after the controller name eg 'posts'
{
    public function create()
    {
        return view('posts/create');
    }
}
