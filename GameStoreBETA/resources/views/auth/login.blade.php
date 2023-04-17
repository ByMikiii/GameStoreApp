@extends('layouts.master')
@section('title', 'Login - Blast')

@section('content')
<div class="container">

                <div class="pt-4 mx-auto my-32 bg-scnd-color rounded-md w-2/5 h-80">
                    <h1 class="text-3xl mb-6 heading">{{ __('auth.login') }}</h1>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        
                        <div class="mb-5">
                                <input class="focus:outline-none focus:border-b-yellow-300 bg-scnd-color border-b" id="email" type="email" placeholder="{{ __('auth.email') }}" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="off" autofocus>

                                @error('email')
                                <?php
                                session()->flash('flash', $message);
                                ?>
                                @enderror
                            </div>


                <div class="">
                                <input class="focus:outline-none focus:border-b-yellow-300 bg-scnd-color border-b" id="password" type="password" placeholder="{{ __('auth.pass') }}" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span text></span>
                                @enderror
                </div>


                                {{-- <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('auth.remember') }}
                                    </label>
                                </div> --}}
                                <button type="submit" class="mt-5 mb-5 mybutton bg-yellow-300 p-2 text-black hover:brightness-110">
                                    {{ __('auth.loginin') }}
                                </button>
                    </form>
                    
                            <br>
                                @if (Route::has('password.request'))
                                    <a class="" href="{{ route('password.request') }}">
                                        {{ __('auth.forgot') }}
                                    </a>
                                @endif
    </div>
</div>
@endsection
