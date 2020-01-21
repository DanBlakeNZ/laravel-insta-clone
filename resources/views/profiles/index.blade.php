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
				<a href="#">Add New Post</a>
			</div>
			<div class="d-flex">
				<div class="pr-5"><strong>153</strong> post</div>
				<div class="pr-5"><strong>23k</strong> followers</div>
				<div class="pr-5"><strong>212</strong> following</div>
			</div>
		<div class="pt-4 font-weight-bold"> {{ $user->profile->title }}</div>
		<div>{{ $user->profile->description }}</div>
		<div><a href="{{ $user->profile->url }}" class="font-weight-bold" style="color: #003569">{{ $user->profile->url }}</a></div>
		</div>
	</div>

	<div class="row pt-5">
		<div class="col-4">
			<img src="https://scontent-syd2-1.cdninstagram.com/v/t51.2885-15/e35/c0.0.748.748a/s480x480/75458059_193034398548309_6670294561319117950_n.jpg?_nc_ht=scontent-syd2-1.cdninstagram.com&_nc_cat=109&_nc_ohc=HFhaf5SdgDYAX8LdKCS&oh=a74db426d866f48dc32957d63bfa84f2&oe=5ED9F440" class="w-100">
		</div>
		<div class="col-4">
			<img src="https://scontent-syd2-1.cdninstagram.com/v/t51.2885-15/e35/c0.1.743.743a/s480x480/79013780_988511461518028_6762939584770433774_n.jpg?_nc_ht=scontent-syd2-1.cdninstagram.com&_nc_cat=104&_nc_ohc=bHSqppji5DMAX971n8V&oh=966e4dc93e54fa66f3320c4b3281c6ae&oe=5EBB5783" class="w-100">
		</div>
		<div class="col-4">
			<img src="https://scontent-syd2-1.cdninstagram.com/v/t51.2885-15/e35/c0.115.933.933a/s480x480/73319948_3118988548118480_2584593794372883946_n.jpg?_nc_ht=scontent-syd2-1.cdninstagram.com&_nc_cat=108&_nc_ohc=acSBt591CckAX-bHmBj&oh=84c695edec18a3e999bc3b74b3bea6da&oe=5ED856F8" class="w-100">
		</div>
	</div>

</div>
@endsection
