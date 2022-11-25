@extends('template.main')

@section('container')
    <main class="form-register w-100 m-auto">
        <form action="{{ route('store') }}" method="POST">
            @csrf
            <h1 class="h3 mb-3 fw-normal text-center">Please Register</h1>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-floating mt-3">
                        <input type="text" class="form-control  @error('nama') is-invalid  @enderror" name="nama"
                            id="nama" placeholder="nama" value="{{ old('nama') }}">
                        <label for="nama">Nama</label>
                    </div>
                    @error('nama')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="form-floating mt-3">
                        <input type="text" class="form-control @error('username') is-invalid @enderror" name="username"
                            id="username" placeholder="username" value="{{ old('username') }}">
                        <label for="username">Username</label>
                    </div>
                    @error('username')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="form-floating mt-3">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                            name="password" placeholder="Password">
                        <label for="password">Password</label>
                    </div>
                    @error('password')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="form-floating mt-3">
                        <input type="password" class="form-control @error('password_confirm') is-invalid @enderror"
                            id="password_confirm" name="password_confirm" placeholder="Password Confirmation">
                        <label for="password">Password Confirmation</label>
                    </div>
                    @error('password_confirm')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>


            <div class="row mt-4">
                <div class="col-md-12">
                    <button class="w-100 btn btn-lg btn-primary" type="submit">Register</button>
                </div>
            </div>
        </form>
        <div class="row">
            <div class="col-md-12">
                <small class="d-block text-center mt-2">
                    Have an account? <a href="{{ route('index') }}" class="text-decoration-none">Login</a>
                </small>
            </div>
        </div>
    </main>
@endsection
