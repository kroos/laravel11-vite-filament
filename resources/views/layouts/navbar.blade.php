<!-- navigator -->
<nav class="navbar navbar-expand-lg align-self-start bg-primary rounded m-0 mb-1" data-theme="dark" style="--bg-opacity: .25;">
	<div class="container">
			<a class="navbar-brand" href="@auth{{ url('/dashboard') }}@else{{ url('/') }}@endauth">
				{!! config('app.name') !!}<img src="">
			</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarColor01">
			<ul class="navbar-nav me-auto">
				<li class="nav-item">
						<a class="nav-link" href="
							@auth
								{{ url('/dashboard') }}
							@else
								{{ url('/') }}
							@endauth
						">
							@auth
								Dashboard
							@else
								Home
							@endauth
							<span class="visually-hidden">(current)</span>
						</a>
				</li>


				@auth
					@include('layouts.navigation')
				@else
					<!-- nav for guest -->
				@endauth
			</ul>
			@if (Route::has('login'))
				@auth
					<div class="dropdown me-5">
						<a href="#" class="btn btn-sm btn-outline-secondary dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              {{ Auth::user()->belongstouser->name }}
            </a>
						<ul class="dropdown-menu">
							<li>
								<a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="fa-regular fa-user"></i> Profile</a>
							</li>
							<li>
								<!-- notification -->
								@include('layouts.notification')
							</li>
							<form method="POST" action="{{ route('logout') }}">
								@csrf
								<li>
									<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();"><i class="fas fa-light fa-right-from-bracket"></i> Log Out</a>
								</li>
							</form>
						</ul>
					</div>

				@else
					<a class="btn btn-sm btn-secondary {{ (Route::has('register'))?'me-1':'me-5' }}" href="{{ route('login') }}">Sign in</a>
					@if (Route::has('register'))
						<a href="{{ route('register') }}" class="btn btn-sm btn-secondary me-5">Sign up</a>
					@endif
				@endauth
			@endif
			<!-- <form class="d-flex">
				<input class="form-control me-sm-2" type="search" placeholder="Search">
				<button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
			</form> -->
		</div>
	</div>
</nav>
<!-- end navigation -->
