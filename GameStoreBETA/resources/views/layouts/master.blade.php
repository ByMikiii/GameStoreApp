<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>@yield('title', 'laravel')</title>
  <link rel="stylesheet" href="/css/app.css">
  <link rel="icon" href="{{ asset('favicon.png') }}" type="image/x-icon">
</head>
<body class="bg-bg-color">
  <nav class="h-12 font-bold flex border-b">
    <a class="flex" href="/"><img class="h-full my-auto" src="{{ asset('favicon.png') }}" alt="logo"></a>
    <span class="flex items-center h-full ml-1 pr-2">Blast</span>

    <a class="m-2 p-1 " href="/">Store</a>
    <a class="m-2 p-1 " href="/community">Community</a>

    @if (Auth::check())
    <a class="m-2 p-1 " href="/library">Library</a>
    <a class="m-2 p-1" href="/friends">Friends</a>
    <a class="m-2 p-1 " href="/profile">{{Auth::user()->name}}</a> 

    <a class="m-2 p-1 ml-auto" href="/">{{Auth::user()->wallet}} €</a>
    <form class="m-2 p-1" method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="btn btn-primary text-red-600">Logout</button>
    </form>


    @else
    <a class="m-2 p-1 ml-auto" href="/login">Login</a>
    <a class="m-2 p-1 " href="/register">Register</a>

    @endif

  </nav>


  <main class="text-red-300">
    @yield('content')
  </main>

  <footer class="text-xs fixed bottom-0 left-0">©2022 ByMikiii</footer>
  <script type="module" src="/js/app.js"></script>
  @yield('scripts')
</body>
</html>
