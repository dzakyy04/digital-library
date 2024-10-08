@extends('auth.layout')

@section('content')
    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <h4 class="nk-block-title">Masuk</h4>
            <div class="nk-block-des">
                <p>Silahkan masukkan email dan password anda.</p>
            </div>
        </div>
    </div>
    <form action="{{ route('login') }}" method="POST">
        @csrf
        <div class="form-group">
            <div class="form-label-group">
                <label class="form-label" for="email">Email</label>
            </div>
            <div class="form-control-wrap">
                <input type="text" class="form-control form-control-lg @error('email') is-invalid @enderror"
                    id="email" name="email" placeholder="Masukkan email anda" value="{{ old('email') }}">
            </div>
            @error('email')
                <div class="mt-1 small text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <div class="form-label-group">
                <label class="form-label" for="password">Password</label>
            </div>
            <div class="form-control-wrap">
                <a href="#" class="form-icon form-icon-right passcode-switch lg" data-target="password">
                    <em class="passcode-icon icon-show icon ni ni-eye"></em>
                    <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                </a>
                <input type="password" class="form-control form-control-lg @error('password') is-invalid @enderror"
                    id="password" name="password" placeholder="Masukkan password anda">
            </div>
            @error('password')
                <div class="mt-1 small text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group d-flex justify-between">
            <div class="custom-control custom-control-sm custom-checkbox checked">
                <input type="checkbox" class="custom-control-input" id="remember" name="remember">
                <label class="custom-control-label" for="remember">Ingat saya</label>
            </div>
        </div>
        <div class="form-group">
            <button type="submit" id="btnSubmit" class="btn btn-lg btn-primary btn-block">
                <span>Masuk</span>
            </button>
        </div>
    </form>
    <div class="mt-3 text-center">
        <p>Belum punya akun? <a href="{{ route('register.view') }}" class="link link-primary">Daftar</a></p>
    </div>
@endsection
