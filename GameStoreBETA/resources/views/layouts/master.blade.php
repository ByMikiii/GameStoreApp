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
  <nav class="h-12 bg-slate-100 relative">
      <a href="" class="h-full bg-yellow-100 text-black">lol</a>
  </nav>

  <main>
    @yield('content')
  </main>

  @yield('scripts')
  <script type="module" src="/js/app.js"></script>
</body>
</html>
