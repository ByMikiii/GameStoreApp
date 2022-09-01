<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>@yield('title', 'laravel')</title>
  <link rel="stylesheet" href="app.css">
  <link rel="icon" href="{{ asset('favicon.png') }}" type="image/x-icon">
</head>
<body>
  <main>
    @yield('content')
  </main>

  @yield('scripts')
</body>
</html>
