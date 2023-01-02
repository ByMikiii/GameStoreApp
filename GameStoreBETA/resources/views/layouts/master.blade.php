<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>@yield('title', 'laravel')</title>
  <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Paytone+One" />
  <link rel="stylesheet" href="/css/app.css">

  <link rel="icon" href="{{ asset('favicon.png') }}" type="image/x-icon">
</head>
<body class="h-full scroll-smooth">
  <header class="flex border-b">
      <a class="m-auto w-auto h-11 flex-shrink-0 flex" href="/">
        <img class="h-full my-auto" src="{{ asset('favicon.png') }}" alt="logo">
        <h1 class="text-3xl text-orange-400 mt-auto"></h1>
      </a>

    <nav class="w-full my-auto">
    <ul id="nav-pc" class="h-12 w-full font-bold flex">

    <li class="list-item"><a href="/">Market</a></li>
    <li class="list-item"><a  href="/community">Community</a></li>

    @if (Auth::check())
    <li class="list-item"><a  href="/library">Library</a></li>
    <li class="list-item"><a href="/friends">Friends</a></li>
    <li class="list-item"><a  href="/profile">{{Auth::user()->name}}</a></li>

    <li class="list-item ml-auto"><a href="/">{{Auth::user()->wallet}} €</a></li>
    <form class="m-2 p-1" method="POST" action="{{ route('logout') }}">
        @csrf
        <li><button type="submit" class="btn btn-primary text-red-600">Logout</button></li>
    </form>


    @else
    <li class="list-item ml-auto"><a href="/login">Login</a></li>
    <li class="list-item"><a  href="/register">Register</a></li>

    @endif
    </ul>
</nav>


  <div id="hamburger-icon" onclick="mobileNav()">
  <div class="bar1"></div>
  <div class="bar2"></div>
  <div class="bar3"></div>
</div>
</header>
  <ul id="mobile-menu" class="border fixed w-full text-center bg-bg-color" style="display: none;">

    <li class="list-item border-b"><a href="/">Market</a></li>
    <li class="list-item border-b"><a  href="/community">Community</a></li>

    @if (Auth::check())
    <li class="list-item border-b"><a  href="/library">Library</a></li>
    <li class="list-item border-b"><a href="/friends">Friends</a></li>
    <li id="logged" class="list-item border-b"><a  href="/profile">{{Auth::user()->name}}</a></li>

    <li class="list-item ml-auto border-b"><a href="/">{{Auth::user()->wallet}} €</a></li>
    <form class="m-2 p-1" method="POST" action="{{ route('logout') }}">
        @csrf
        <li><button type="submit" class="btn btn-primary text-red-600">Logout</button></li>
    </form>


    @else
    <li class="flex relative">
    <a class="list-item ml-auto pr-36" href="/login">Login</a>
    <a class="list-item mr-auto pl-36" href="/register">Register</a>
    </li>
    @endif
  </ul>

  <main id="app" class="text-yellow-300 mt-5">
    @yield('content')

    <flash-message text="{{session('flash')}}"></flash-message>
    
    @if (Auth::check())
    <section id='global-chat' class='bg-bg-color fixed bottom-16 right-2 border w-96 h-5/6 rounded-sm flex-col flex invisible'>
      <h1 class='text-center text-2xl w-full border-b p-1 pb-2'>Global Chat</h1>
      <global-chat-log class='p-1 pr-3 scrollbar-thin scrollbar-thumb-gray-800 scrollbar-track-bg-color' :messages="globalMessages" :auth="{{Auth::user()}}"></global-chat-log>
      <global-chat-composer v-on:messagesent="addMessage" :auth="{{Auth::user()}}"></global-chat-composer>
    </section>
    <button class='fixed bottom-6 right-6' onclick="globalChat()">Global Chat</button>
    @endif
  </main>

  <footer class="text-xs fixed bottom-0 left-0">©2022 ByMikiii</footer>

  <script src="{{ asset('js/app.js')}}"></script>
  <script src="/js/script.js"></script>

  @yield('scripts')
</body>
</html>
