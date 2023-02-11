<?php
if(Auth::check()){
App::setLocale('sk');
}else App::setLocale('sk');
?>

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
<body class="h-full overflow-y-scroll scrollbar-thin scrollbar-thumb-gray-800 scrollbar-track-bg-color">
  <header class="flex border-b">
      <a class="m-auto w-auto h-11 flex-shrink-0 flex" href="/">
        <img class="h-full my-auto" src="{{ asset('favicon.png') }}" alt="logo">
        <h1 class="text-3xl text-orange-400 mt-auto"></h1>
      </a>

    <nav class="w-full my-auto">
    <ul id="nav-pc" class="h-12 w-full font-bold flex">

    <li id="market" class="list-item"><a href="/">{{__('master.market')}}</a></li>
    <li id="community" class="list-item"><a  href="/community">{{__('master.community')}}</a></li>

    @if (Auth::check())
    <li id="library" class="list-item"><a  href="/library">{{__('master.library')}}</a></li>
    <li id="friends" class="list-item"><a href="/friends">{{__('master.friends')}}</a></li>
    <li id="profile" class="list-item"><a  href="/profile">{{strtoupper(Auth::user()->name)}}</a></li>

    <a id="balance" href="/balance" class="list-item ml-auto hover:text-link-color">{{Auth::user()->wallet}} € </a>
    
    <a href="/basket" class="flex">
      <span class="bg-red-600 rounded-md w-4 h-4 text-center text-xs basket-badge hover:text-white" id="basketitemscount">
        {{Auth::user()->basketitems()->get()->count()}}</span>
      <svg id="basket" class="list-item w-10 h-10 hover:fill-link-color" fill="#999999" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 902.86 902.86" xml:space="preserve" data-darkreader-inline-fill="" style="--darkreader-inline-fill:#181a1b; --darkreader-inline-stroke:#e8e6e3;" stroke="#ffffff" data-darkreader-inline-stroke=""><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g> <path d="M671.504,577.829l110.485-432.609H902.86v-68H729.174L703.128,179.2L0,178.697l74.753,399.129h596.751V577.829z M685.766,247.188l-67.077,262.64H131.199L81.928,246.756L685.766,247.188z"></path> <path d="M578.418,825.641c59.961,0,108.743-48.783,108.743-108.744s-48.782-108.742-108.743-108.742H168.717 c-59.961,0-108.744,48.781-108.744,108.742s48.782,108.744,108.744,108.744c59.962,0,108.743-48.783,108.743-108.744 c0-14.4-2.821-28.152-7.927-40.742h208.069c-5.107,12.59-7.928,26.342-7.928,40.742 C469.675,776.858,518.457,825.641,578.418,825.641z M209.46,716.897c0,22.467-18.277,40.744-40.743,40.744 c-22.466,0-40.744-18.277-40.744-40.744c0-22.465,18.277-40.742,40.744-40.742C191.183,676.155,209.46,694.432,209.46,716.897z M619.162,716.897c0,22.467-18.277,40.744-40.743,40.744s-40.743-18.277-40.743-40.744c0-22.465,18.277-40.742,40.743-40.742 S619.162,694.432,619.162,716.897z"></path> </g> </g> </g></svg>
    </a>
    <form class="m-2 p-1" method="POST" action="{{ route('logout') }}">
        @csrf
        <li><button type="submit" class="btn btn-primary text-red-600">{{__('master.logout')}}</button></li>
    </form>


    @else
    <li id="login" class="list-item ml-auto"><a href="/login">{{__('master.login')}}</a></li>
    <li id="register" class="list-item"><a  href="/register">{{__('master.register')}}</a></li>

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


    <li class="list-item ml-auto border-b"><a href="/" id="wallet">{{Auth::user()->wallet}} €</a></li>
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

  <main id="app" class="mt-5 w-5/6 h-full text-center mx-auto">
    @yield('content')

    <?php if(Auth::check()): ?>
    <notification :auth="{{Auth::user()}}"></notification>
    <?php endif; ?>

    <flash-message text="{{session('flash')}}"></flash-message>
    
    @if (Auth::check())
    <section id='global-chat' class='bg-bg-color fixed bottom-16 right-2 border w-96 h-5/6 rounded-sm flex-col flex invisible'>
      <h1 class='text-center text-2xl w-full border-b p-1 pb-2 heading'>Global Chat</h1>
      <global-chat-log class='p-1 pr-3 scrollbar-thin scrollbar-thumb-gray-800 scrollbar-track-bg-color' :messages="globalMessages" :auth="{{Auth::user()}}"></global-chat-log>
      <global-chat-composer v-on:globalmessagesent="addMessage" :auth="{{Auth::user()}}"></global-chat-composer>
    </section>
    <button class='fixed bottom-6 right-6' onclick="globalChat()"><svg class="w-10 fill-link-color hover:fill-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M256 448c141.4 0 256-93.1 256-208S397.4 32 256 32S0 125.1 0 240c0 45.1 17.7 86.8 47.7 120.9c-1.9 24.5-11.4 46.3-21.4 62.9c-5.5 9.2-11.1 16.6-15.2 21.6c-2.1 2.5-3.7 4.4-4.9 5.7c-.6 .6-1 1.1-1.3 1.4l-.3 .3 0 0 0 0 0 0 0 0c-4.6 4.6-5.9 11.4-3.4 17.4c2.5 6 8.3 9.9 14.8 9.9c28.7 0 57.6-8.9 81.6-19.3c22.9-10 42.4-21.9 54.3-30.6c31.8 11.5 67 17.9 104.1 17.9zM128 208a32 32 0 1 1 0 64 32 32 0 1 1 0-64zm128 0a32 32 0 1 1 0 64 32 32 0 1 1 0-64zm96 32a32 32 0 1 1 64 0 32 32 0 1 1 -64 0z"/></svg></button>
    
    @endif
  </main>


  <footer class="text-xs fixed bottom-0 left-0">©2023 Bardáč</footer>

  <script src="{{ asset('js/app.js')}}"></script>
  <script src="/js/script.js"></script>

  @yield('scripts')
</body>
</html>
