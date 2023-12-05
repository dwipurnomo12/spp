@extends('layouts.app')

@section('auth')
    <div class="card">
        <div class="row align-items-center text-center">
            <div class="col-md-12">
                <div class="card-body">
                    <h4 class="mb-3 f-w-400">Sign In</h4>
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label class="floating-label" for="username">Username</label>
                            <input id="username" type="text" class="form-control @error('username') is-invalid @enderror"
                                name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-4">
                            <label class="floating-label" for="Password">Password</label>
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="custom-control custom-checkbox text-left mb-4 mt-2">
                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                            <label class="custom-control-label" for="customCheck1">Simpan Info Login</label>
                        </div>
                        <button type="submit" class="btn btn-block btn-primary mb-4">Sign in</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
