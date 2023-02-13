@extends('layouts.master')
@section('title', 'Register - Blast')

@section('content')
<div class="container">
    <div class="pt-4 mx-auto my-32 bg-scnd-color rounded-md w-2/5 h-96">

                <h1 class="text-3xl mb-6 heading">{{ __('auth.register') }}</h1>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                            <div class="mb-5">
                                <input class="focus:outline-none focus:border-b-yellow-300 bg-scnd-color border-b" placeholder="{{ __('auth.name') }}" id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <?php
                                        session()->flash('flash', $message);
                                    ?>
                                @enderror
                            </div>

                            <div class="mb-5">
                                <input class="focus:outline-none focus:border-b-yellow-300 bg-scnd-color border-b" placeholder="{{ __('auth.email') }}" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <?php
                                        session()->flash('flash', $message);
                                    ?>
                                @enderror
                            </div>

                            <div class="mb-5">
                                <input class="focus:outline-none focus:border-b-yellow-300 bg-scnd-color border-b" id="password" placeholder="{{ __('auth.pass') }}" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="off">

                                @error('password')
                                    <?php
                                        session()->flash('flash', $message);
                                    ?>
                                @enderror
                            </div>

                            <div class="mb-5">
                                <input class="focus:outline-none focus:border-b-yellow-300 bg-scnd-color border-b" id="password-confirm" placeholder="{{ __('auth.passconf') }}" type="password" class="form-control" name="password_confirmation" required autocomplete="off">
                            </div>

                        <div class="">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class=" mt-5 mybutton bg-yellow-300 p-2 text-black hover:brightness-110">
                                    {{ __('auth.registerin') }}
                                </button>
                            </div>
                        </div>
                    </form>
            </div>
    </div>
</div>
@endsection
