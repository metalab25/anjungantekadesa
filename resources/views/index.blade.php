@extends('layouts.app')


@section('content')

@include('header')
<div class="row justify-content-center">
    <div class="col-md-4 mx-auto">
        {{-- @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form method="POST" action="{{ route('login.store') }}">
            @csrf
            <div class="form-group">
                <label for="nik">NIK</label>
                <input type="text" class="form-control" id="nik" name="nik" value="{{ old('nik') }}" required autofocus>
            </div>
            <div class="form-group">
                <label for="pin">PIN</label>
                <input type="password" class="form-control" id="pin" name="pin" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div> --}}
</div>
@endsection
