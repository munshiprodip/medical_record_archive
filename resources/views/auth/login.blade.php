@extends("layouts.auth")

@section('content')
    <h3 class="mb-1 fw-bold">Medical Record Archive</h3>
        <p class="mb-4">
            Please sign-in to your account
        </p>

        <form id="formAuthentication" class="mb-3" method="POST" action="{{ route('login') }}" >
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email or Username</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email or username" required autofocus autocomplete="username" />
            </div>

            <div class="mb-3 form-password-toggle">
                <div class="d-flex justify-content-between">
                    <label class="form-label" for="password">Password</label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">
                            <small>Forgot Password?</small>
                        </a>
                    @endif
                </div>
                <div class="input-group input-group-merge">
                    <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" required aria-describedby="password" />
                    <span class="input-group-text cursor-pointer" ><i class="ti ti-eye-off"></i ></span>
                </div>
            </div>

            <div class="mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="remember-me" name="remember" />
                    <label class="form-check-label" for="remember-me">
                        Remember Me
                    </label>
                </div>
            </div>

            <button class="btn btn-primary d-grid w-100">Sign in</button>
        </form>

        @if (Route::has('register'))
            <p class="text-center">
                <span>New on our platform?</span>
                <a href="{{ route('register') }}">
                    <span>Create an account</span>
                </a>
            </p>
        @endif

       
@endsection