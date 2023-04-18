@extends('layouts.master')
@section('title', 'Login - Blast')

@section('content')
<div class="container">

                <div class="pt-8 pb-4 mx-auto bg-scnd-color rounded-md w-2/5 my-44">
                    <h1 class="text-3xl mb-6 heading">{{ __('auth.login') }}</h1>

                    <form class="mb-4" method="POST" action="{{ route('login') }}">
                        @csrf

                        
                        <div class="mb-5">
                                <input class="w-56 focus:outline-none focus:border-b-tx-color bg-scnd-color border-b p-1" id="email" type="email" placeholder="{{ __('auth.email') }}" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="off" autofocus>

                                @error('email')
                                <?php
                                session()->flash('flash', $message);
                                ?>
                                @enderror
                            </div>


                <div class="">
                                <input class="w-56 focus:outline-none focus:border-b-tx-color bg-scnd-color border-b p-1" id="password" type="password" placeholder="{{ __('auth.pass') }}" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

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
                                <button type="submit" class="w-56 mt-5 mb-2.5 mybutton bg-tx-color p-2 text-black hover:brightness-110">
                                    {{ __('auth.loginin') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="block hover:text-tx-color" href="{{ route('password.request') }}">
                                        {{ __('auth.forgot') }}
                                    </a>
                                @endif

                    </form>
                    
                                
    </div>
</div>
@endsection
