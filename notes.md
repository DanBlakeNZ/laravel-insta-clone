In Laravel 6.0 you need to use {{ Auth::user()->username }} instead  {{ $user->username }

return $this->image ?: 'noimage.jpg';

If just plain User:all(); doesn't work for you, try it like this: App\User::all();
