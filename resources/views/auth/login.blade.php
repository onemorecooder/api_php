<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <title>Login</title>
</head>

<body>
    @include('includes.navbarLogin')
    <div class="container">
        <div class="mt-5 mb-3">
            <h1>{{ __('Login') }}</h1>
        </div>

        <form method="POST" action="{{ route('login') }}" class="mb-3">
            @csrf
            @method('POST')

            <div class="form-group">
                <label for="email">{{ __('E-Mail Address') }}</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                    <span role="alert" class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">{{ __('Password') }}</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password" required autocomplete="current-password">

                @error('password')
                    <span role="alert" class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" name="remember" id="remember"
                    {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember">{{ __('Remember Me') }}</label>
            </div>

            <button type="submit" class="btn btn-primary">{{ __('Login') }}</button>
            <a href="{{ route('register') }}" class="btn btn-link">{{ __('Register') }}</a>
            <a href="{{ route('redirectToGoogle') }}" class="btn btn-link">{{ __('Login with Google') }}</a>
        </form>
    </div>
    @include('includes.footer')
</body>

</html>
