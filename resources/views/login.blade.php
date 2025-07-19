@extends('layouts.surat')

@section('title', 'Login Layanan Mandiri')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-4">
        <form method="POST" action="{{ route('login.store') }}">
            @csrf
            <div class="mb-3">
                <label for="nik" class="form-label">NIK</label>
                <input type="text" class="form-control" id="nik" name="nik" value="{{ old('nik') }}" required autofocus>
            </div>
            <div class="mb-3">
                <label for="pin" class="form-label">PIN</label>
                <input type="password" class="form-control" id="pin" name="pin" required>
            </div>
            @if($errors->has('login'))
                <div class="alert alert-danger">{{ $errors->first('login') }}</div>
            @endif
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
    </div>
</div>
@endsection
