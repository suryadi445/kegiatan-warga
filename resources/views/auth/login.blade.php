@extends('template.main')

@section('container')
    <main class="form-signin w-100 m-auto">
        <x-toast></x-toast>

        <form action="{{ route('authenticate') }}" method="POST">
            @csrf
            <h1 class="h3 mb-3 fw-normal text-center">Please Login</h1>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-floating">
                        <input type="text" class="form-control @error('username') is-invalid @enderror" name="username"
                            id="username" placeholder="username" value="{{ old('username') }}">
                        <label for="username">Username</label>
                    </div>
                    @error('username')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="form-floating">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                            name="password" placeholder="Password" value="{{ old('password') }}">
                        <label for="password">Password</label>
                    </div>
                    @error('password')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    <small class="text-end d-block">
                        <a href="" class="text-decoration-none">
                            Forgot Password
                        </a>
                    </small>
                </div>
            </div>


            <div class="row mt-4">
                <div class="col-md-12">
                    <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
                </div>
            </div>
        </form>
        <div class="row">
            <div class="col-md-12">
                <small class="d-block text-center mt-2">
                    Not Registered? <a href="{{ route('register') }}" class="text-decoration-none">Register</a>
                </small>
            </div>
        </div>
    </main>
@endsection
