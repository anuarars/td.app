<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.green.min.css"/>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="hero-anime">	
	<div class="navigation-wrap bg-light start-header start-style">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<nav class="navbar navbar-expand-md navbar-light">
					
						<a class="navbar-brand" href="{{ url('/') }}" target="_blank"><span class="logo">{{ config('app.name', 'Laravel') }}</span></a>	
						
						<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
							<span class="navbar-toggler-icon"></span>
						</button>
						<div class="collapse navbar-collapse" id="navbarSupportedContent">
							<ul class="navbar-nav ml-auto py-4 py-md-0">
								<li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
									<a class="nav-link" href="/">Главная</a>
                                </li>
                                @foreach ($pages as $page)
                                    <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                                        <a class="nav-link" href="{{route('page.show', $page->id)}}">{{$page->name}}</a>
                                    </li>
                                @endforeach
                            @guest
                                <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
									<a class="nav-link" href="{{ route('login') }}">Войти / Регистрация</a>
								</li>
                            @else
                                @if (Auth::user()->hasRole('client'))
                                    <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                                        <a class="nav-link" href="{{route('client.account.index')}}">Аккаунт</a>
                                    </li>
                                @endif

                                @if (Auth::user()->hasRole('worker'))
                                    <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                                        <a class="nav-link" href="{{route('worker.account.index')}}">Аккаунт</a>
                                    </li>
                                @endif

                                @if (Auth::user()->hasRole('admin'))
                                    <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                                        <a class="nav-link" href="{{route('admin.user.index')}}">Аккаунт</a>
                                    </li>
                                @endif
                                
                                <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                                    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">Выйти</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            @endguest
                                <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4" style="padding-top: 12px;">
                                    <div id="switch" class="float-left">
                                        <div id="circle"></div>
                                    </div>
                                </li>
							</ul>
						</div>
					</nav>		
				</div>
			</div>
		</div>
	</div>
	<div class="mt-5 pt-5">
        <main>
            @yield('content')
        </main>
    </div>
    <footer class="footer">
        <ul class="d-flex justify-content-between align-items-center w-75">
            <li>
                <a class="text-dark" href=""><i class="fab fa-2x fa-facebook-f"></i></a>
            </li>
            <li>
                <a class="text-dark" href=""><i class="fab fa-2x fa-vk"></i></i></a>
            </li>
            <li>
                <a class="text-dark" href=""><i class="fab fa-2x fa-instagram"></i></a>
            </li>
            <li>
                <a class="text-dark" href=""><i class="fab fa-2x fa-telegram-plane"></i></i></a>
            </li>
            <li>
                <a class="text-dark" href=""><i class="fab fa-2x fa-whatsapp"></i></i></a>
            </li>
        </ul>
    </footer>
</body>
</html>
