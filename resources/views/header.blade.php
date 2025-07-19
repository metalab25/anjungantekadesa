<header class="header-2">
    <div class="page-header min-vh-75 relative" style="background-image: url('https://images.unsplash.com/photo-1445452916036-9022dfd33aa8?q=80&amp;w=2973&amp;auto=format&amp;fit=crop&amp;ixlib=rb-4.0.3&amp;ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D')">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 text-center mx-auto">
                    <div class="d-flex justify-content-center mt-4">
                        <img src="{{ $config->website . '/storage' . $config->logo }}" alt="Logo" width="100" class="img-fluid mb-4">
                    a.btn.btn-primary 
                    </div>
                    @if ($errors->any())
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
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="nik">NIK</label>
                                    <input type="text" class="form-control text-center" id="nik" name="nik" placeholder="Masukan NIK atau nomor telepon" value="{{ old('nik') }}" required autofocus>
                                </div>
                                <div class="form-group">
                                    <label for="pin">PIN</label>
                                    <input type="password" class="form-control text-center" id="pin" name="pin" required placeholder="Masukan PIN">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="position-absolute w-100 z-index-1 bottom-0">
        <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 40" preserveAspectRatio="none" shape-rendering="auto">
            <defs>
                <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z">
                </path>
            </defs>
            <g class="moving-waves">
                <use xlink:href="#gentle-wave" x="48" y="-1" fill="rgba(255,255,255,0.40"></use>
                <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(255,255,255,0.35)"></use>
                <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(255,255,255,0.25)"></use>
                <use xlink:href="#gentle-wave" x="48" y="8" fill="rgba(255,255,255,0.20)"></use>
                <use xlink:href="#gentle-wave" x="48" y="13" fill="rgba(255,255,255,0.15)"></use>
                <use xlink:href="#gentle-wave" x="48" y="16" fill="rgba(255,255,255,0.95"></use>
            </g>
        </svg>
    </div>
    </div>
</header>
