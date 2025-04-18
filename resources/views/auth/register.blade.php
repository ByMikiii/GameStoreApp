@extends('layouts.master')
@section('title', 'Register - Blast')

@section('content')
<div class="container">
    <div class="pt-4 pb-8 mx-auto my-44 bg-scnd-color rounded-md w-2/5">

                <h1 class="text-3xl mb-6 heading">{{ __('auth.register') }}</h1>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                            <div class="mb-5">
                                <input class="w-56 focus:outline-none focus:border-b-tx-color p-1 bg-scnd-color border-b" placeholder="{{ __('auth.name') }}" id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <?php
                                        session()->flash('flash', $message);
                                    ?>
                                @enderror
                            </div>

                            <div class="mb-5">
                                <input class="w-56 focus:outline-none focus:border-b-tx-color p-1 bg-scnd-color border-b" placeholder="{{ __('auth.email') }}" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <?php
                                        session()->flash('flash', $message);
                                    ?>
                                @enderror
                            </div>

                            <div class="mb-5">
                                <input class="w-56 focus:outline-none focus:border-b-tx-color p-1 bg-scnd-color border-b" id="password" placeholder="{{ __('auth.pass') }}" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="off">

                                @error('password')
                                    <?php
                                        session()->flash('flash', $message);
                                    ?>
                                @enderror
                            </div>

                            <div class="">
                                <input class="w-56 focus:outline-none focus:border-b-tx-color p-1 bg-scnd-color border-b" id="password-confirm" placeholder="{{ __('auth.passconf') }}" type="password" class="form-control" name="password_confirmation" required autocomplete="off">
                            </div>

                                <button type="submit" class="w-56 mt-5 mb-2.5 mybutton bg-tx-color p-2 text-black hover:brightness-110">
                                    {{ __('auth.registerin') }}
                                </button>

                        
                    </form>
            </div>
    </div>
</div>
@endsection
