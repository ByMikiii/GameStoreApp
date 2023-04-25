@extends('layouts.master')
@section('title', 'Reset password')

@section('content')


    <?php
        if(Auth::check()){
        App::setLocale(Auth::user()->locale);
        }else App::setLocale('sk');
    ?>

                <div class="pt-4 mx-auto my-32 bg-scnd-color rounded-md w-2/5 h-80">
                <div class="heading text-2xl mb-8">{{ __('reset.changepassword') }}</div>

                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="row mb-5">
                            <div class="col-md-6">
                                <input id="email" type="email" class="w-64 focus:outline-none focus:border-b-yellow-300 bg-scnd-color border-b form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus placeholder="{{__('reset.email')}}">

                                @error('email')
                                    <?php
                                    session()->flash('flash', $message);
                                    ?>
                                    {{-- <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span> --}}
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-5">

                            <div class="col-md-6">
                                <input id="password" type="password" class="w-64 focus:outline-none focus:border-b-yellow-300 bg-scnd-color border-b form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="{{__('reset.newpassword')}}">

                                @error('password')
                                    <?php
                                    session()->flash('flash', $message);
                                    ?>
                                    {{-- <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span> --}}
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-5">

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="w-64 focus:outline-none focus:border-b-yellow-300 bg-scnd-color border-b form-control" name="password_confirmation" required autocomplete="new-password" placeholder="{{__('reset.confirmpassword')}}">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="mt-5 mb-5 mybutton bg-tx-color p-2 text-black hover:brightness-110">
                                    {{ __('reset.changepass') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
