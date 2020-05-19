@extends('layouts.app', [ 'dark' => true])



@section('content')
    <section class="content center-content auth-section">
        <div class="container">
            <div class="auth-cover">
                <h1>Кіру</h1>
                <p>немесе <a href="#">жаңа профиль ашу</a></p>
                <form method="POST" action="{{route('login')}}">
                    @csrf
                    <input type="text" placeholder="E-mail" name="email">
                    <input type="password" placeholder="Құпия сөз" name="password">
                    <label class="checkbox-container">
                        Есте сақтау
                        <input type="checkbox" checked="checked">
                        <span class="checkmark-auth"></span>
                    </label>
                    <button type="submit" class="btn-plain btn-auth">Кіру</button>
                </form>
            </div>
        </div>
    </section>
    <div class="footer clearfix">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4 icon-social col-md-push-4">
                    <div class="icon-pred"><a href=""><i class="icons ic-ios"></i>iOS</a><a href=""><i
                                class="icons ic-and"></i>Android</a></div>
                    <div><a href=""><i class="icons ic-ins"></i></a><a href=""><i class="icons ic-fb"></i></a><a href=""><i
                                class="icons ic-ytb"></i></a><a href=""><i class="icons ic-vk"></i></a><a href=""><i
                                class="icons ic-whats"></i></a></div>
                </div>
                <div class="col-md-4 right-footer col-md-push-4">
                    <p class="fs-12 text-grey">Дизайн и разработка</p><a href=""><img src="img/logo/logo_bg.png"></a>
                </div>
                <div class="col-md-4 col-md-pull-8">
                    <p>© 2019<a href=""> Bugin Holding</a></p>
                </div>
            </div>
        </div>
    </div>

{{--<div class="container">--}}
{{--    <div class="row justify-content-center">--}}
{{--        <div class="col-md-8">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">{{ __('Login') }}</div>--}}

{{--                <div class="card-body">--}}
{{--                    <form method="POST" action="{{ route('login') }}">--}}
{{--                        @csrf--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>--}}

{{--                                @error('email')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">--}}

{{--                                @error('password')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <div class="col-md-6 offset-md-4">--}}
{{--                                <div class="form-check">--}}
{{--                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>--}}

{{--                                    <label class="form-check-label" for="remember">--}}
{{--                                        {{ __('Remember Me') }}--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row mb-0">--}}
{{--                            <div class="col-md-8 offset-md-4">--}}
{{--                                <button type="submit" class="btn btn-primary">--}}
{{--                                    {{ __('Login') }}--}}
{{--                                </button>--}}

{{--                                @if (Route::has('password.request'))--}}
{{--                                    <a class="btn btn-link" href="{{ route('password.request') }}">--}}
{{--                                        {{ __('Forgot Your Password?') }}--}}
{{--                                    </a>--}}
{{--                                @endif--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
@endsection
