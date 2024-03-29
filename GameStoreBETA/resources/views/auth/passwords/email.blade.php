@extends('layouts.master')
@section('title', 'Reset password - Blast')

@section('content')

    <?php
        if(Auth::check()){
        App::setLocale(Auth::user()->locale);
        }else App::setLocale('sk');
    ?>

                <div class="pt-4 mx-auto my-48 bg-scnd-color rounded-md w-2/5 h-60">
                <div class="heading text-3xl mb-6">{{ __('reset.resetpassword') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <?php
                        session()->flash('flash', __('passwords.sent'));
                    ?>
                        {{-- <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div> --}}
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="row mb-5">

                            <div class="col-md-6">
                                <input id="email" type="email" class="w-64 focus:outline-none focus:border-b-yellow-300 bg-scnd-color border-b form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="{{__('reset.email')}}" autofocus>

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

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="mt-5 mb-5 mybutton bg-tx-color p-2 text-black hover:brightness-110">
                                    {{ __('reset.send') }}
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
