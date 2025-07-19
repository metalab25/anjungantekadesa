<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Surat')</title>
    @stack('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
</head>
<body>
    <div class="container mt-5">
        @if(session('user'))
            <form action="{{ route('logout') }}" method="POST" class="mb-3 text-end">
                @csrf
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>
        @endif
        @yield('search')
        @yield('content')
    </div>

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('js')
</body>
</html>

@push('css')
<style>
    .card:hover { background: #efefef }
    .item-surat { margin-bottom: 0; text-align: center; min-height: 105px; }
    .item-surat p { font-size: 0.8em; font-weight: 500; }
    .item-surat i { font-size: 2.5em; }
</style>
@endpush
