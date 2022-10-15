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
    <a class="m-1 flex" href=""><img class="h-full" src="{{ asset('favicon.png') }}" alt="logo"> Blast</a>

    <a class="m-2 p-1 " href="/">Store</a>
    <a class="m-2 p-1 " href="/community">Community</a>

    @if (Auth::check())
    <a class="m-2 p-1 " href="/library">Library</a>
    <a class="m-2 p-1" href="">Friends</a>
    <a class="m-2 p-1 " href="/profile">Profile</a> 

    <form class="m-2 p-1 ml-auto" method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="btn btn-primary">Logout</button>
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
