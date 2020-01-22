@extends('layouts.app')

@section('content')
<div class="container">

	<div class="row">
		<div class="col-3 p-5">
			<img src="https://scontent-syd2-1.cdninstagram.com/v/t51.2885-19/s320x320/70985486_577637296311063_2240788552625422336_n.jpg?_nc_ht=scontent-syd2-1.cdninstagram.com&_nc_ohc=bgk4uf-h8cQAX_pb9Q_&oh=b45b176c2b493ad2b3725ffb14acfcf8&oe=5ED1A027" class="rounded-circle" style="max-width: 150px; min-width: 60px; width: 100%;">
		</div>

		<div class="col-9 pt-5">
			<div class="d-flex justify-content-between align-items-baseline">
				<h1>{{ $user->username }}</h1> <!-- $user come from ProfilesController.php -->
				<a href="/p/create">Add New Post</a>
			</div>
			<div class="d-flex">
				<div class="pr-5"><strong>{{ $user->posts->count() }}</strong> posts</div>
				<div class="pr-5"><strong>23k</strong> followers</div>
				<div class="pr-5"><strong>212</strong> following</div>
			</div>
		<div class="pt-4 font-weight-bold"> {{ $user->profile->title }}</div>
		<div>{{ $user->profile->description }}</div>
		<div><a href="{{ $user->profile->url }}" class="font-weight-bold" style="color: #003569">{{ $user->profile->url }}</a></div>
		</div>
	</div>

	<div class="row pt-5">
		@foreach ($user->posts as $post)
		<div class="col-4 pb-4">
			<img src="/storage/{{ $post->image }}" class="w-100">
		</div>
		@endforeach
	</div>

</div>
@endsection
