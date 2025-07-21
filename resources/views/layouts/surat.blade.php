@extends('layouts.app')


@section('content')
    <div class="container mt-5">
       
        @yield('search')
        @yield('content')
    </div>
@endsection
