@extends('auth')

@section('content')
    <section class="section register d-flex flex-column align-items-center justify-content-center">
        <div class="container mt-3">
            <div class="row col-md-12 justify-content-center">
                <div class="col-lg-5 col-md-8 d-flex flex-column align-items-center ">
                    <div class="card mb-1 mt-1">
                        @if (session('success'))
                            <div class="card-body">
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="card-body">
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
                        <div class="card-body">
                            <div class="row mb-1 text-center">
                                <div class="col">
                                    <a href="{{ asset('/') }}"><img src={{ asset('/pembeli/images/logo2.png') }}
                                            alt="" style="width: 130px; "></a>
                                </div>
                            </div>
                            <div class="pb-2">
                                <h2 class="card-title text-center pb-0 fs-4">Masuk</h2>
                                <p class="text-center small">Mohon Input email dan password anda!</p>
                            </div>

                            <form class="row g-3 needs-validation" action="{{ route('login') }}" method="post">
                                @csrf
                                <div class="col-12">
                                    <label for="yourUsername" class="form-label">Email</label>
                                    <div class="input-group has-validation">
                                        <span class=" input-group-text" id="inputGroupPrepend"><i class="fa-solid fa-envelope fa-sm"></i></span>
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" required autocomplete="email" autofocus>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label for="yourPassword" class="form-label">Password</label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text" id="inputGroupPrepend"><i class="fa-solid fa-lock fa-sm"></i></span>
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="current-password" style="border-right-color:white">
                                            <span class="input-group-text bg-white" id="togglePassword"
                                            style="cursor: pointer;border-left-color:white">
                                            <i class="fa-solid fa-eye fa-sm"></i>
                                        </span>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="pt-4 pb-3 px-5 jus">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary w-100">
                                        {{ __('Login') }}
                                    </button>
                                </div>
                                <div class=" row col-12 justify-content-center mt-3">
                                    <p>Belum Punya Akun? <a href="{{ route('register') }}" class="btn text-secondary">Buat
                                            Akun</a></p>
                                </div>
                                <div class=" row col-12 justify-content-center">
                                    <a href="{{ route('password-request') }}" class="btn text-secondary">Lupa
                                        Password</a>
                                </div>
                                {{-- <div class="row col-12 justify-content-center text-secondary">
                                        @if (Route::has('password.request'))
                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        @endif
                                    </div> --}}
                            </form>
                            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
                            <script type="text/javascript">
                                $(document).ready(function() {
                                    $('#togglePassword').click(function() {
                                        let passwordField = $('#password');
                                        let icon = $(this).find('i');
                                        if (passwordField.attr('type') === 'password') {
                                            passwordField.attr('type', 'text');
                                            icon.removeClass('fa-solid fa-eye').addClass('fa-solid fa-eye-slash');
                                        } else {
                                            passwordField.attr('type', 'password');
                                            icon.removeClass('fa-solid fa-eye-slash').addClass('fa-solid fa-eye');
                                        }
                                    });
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>

    </section>
@endsection
