@extends('layouts.master')
@section('title', 'Login - Blast')

@section('content')
<div class="container">

                <div class="pt-4 mx-auto my-40 bg-scnd-color rounded-md w-2/3 h-80">
                    <h1 class="text-3xl mb-4">{{ __('auth.login') }}</h1>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        
                        <div class="mb-4">
                                <input class="bg-scnd-color border-b" id="email" type="email" placeholder="{{ __('auth.email') }}" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <?php
                                session()->flash('flash', $message);
                                ?>
                                @enderror
                            </div>


                <div class="">
                                <input class="bg-scnd-color border-b" id="password" type="password" placeholder="{{ __('auth.pass') }}" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span text></span>
                                @enderror
                </div>


                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('auth.remember') }}
                                    </label>
                                </div>
                    </form>
                    <button type="submit" class="">
                                    {{ __('auth.loginin') }}
                                </button>
                            <br>
                                @if (Route::has('password.request'))
                                    <a class="mt-auto mb-0" href="{{ route('password.request') }}">
                                        {{ __('auth.forgot') }}
                                    </a>
                                @endif
    </div>
</div>
@endsection
