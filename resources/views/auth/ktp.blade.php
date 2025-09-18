@push('css')
<style>
    @media (min-width: 900px) and (height: 1440px) {
        .form-wrapper {
            max-width: 400px;
            margin: 0 auto; /* biar ke tengah */
        }

        .form-control {
            font-size: 1.3rem !important;
            height: 80px !important;
            padding: 0 1rem !important;
            border-radius: 3rem !important;
            text-align: center;
        }

        .card-body {
            background: #f2f0f0;
            padding: 3px;
            border-radius: 1.5rem;
        }
/*
        .form-control::placeholder {
            text-align: left !important;
        } */

        .btn-submit {
            background: #166CDA;
            font-size: 1.4rem !important;
            padding: 1rem !important;
            border-radius: 3rem !important;
            color: white !important;
            width: 100%;
            max-width: 400px; /* tombol juga max 400 */
            display: block;
            margin: 0 auto;
        }

        .login-ktp {
            color: #166CDA;
            text-align: center;
            display: block;
        }
    }

    .btn-submit:disabled {
        background: #cfcfcf !important;
        border: none;
        cursor: not-allowed;
        color: #666 !important;
    }

    .btn-submit {
    background: #166CDA;
    color: white;
    }

    .form-control.is-invalid {
        border: 2px solid red !important;
    }
</style>
@endpush

{{-- Form Login KTP --}}
<div class="d-flex justify-content-end">
    <div class="me-4">
        <a href="{{ route('anjungan') }}" style="text-decoration: underline">Kembali</a>
    </div>
</div>
<div class="card-header pb-0 text-left">
    <div class="d-flex justify-content-center">
        <img src="{{ $apiBase . '/storage/' . $config->logo }}" alt="Logo" width="100" class="img-fluid mb-2">
    </div>
    <h4 class="font-weight-bolder title-anjungan mt-3 mb-3">Scan KTP anda</h4>
    <p class="title-anjungan mt-3 mb-3">Tempelkan KTP Anda di scanner anjungan mandiri</p>
</div>
<div class="card-body py-2 border">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0" style="list-style-type: none">
                @foreach ($errors->all() as $error)
                    <li class="text-white">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <img src="{{ asset('assets/img/scan_ktp.png') }}" alt="{{ config('app.nama') }}"
        class="img-fluid py-5" width="300">
    <form method="POST" action="{{ route('login.auth_ktp') }}" class="mb-4" id="loginKtpForm">
        @csrf
        <div class="form-group">
            <input type="hidden" class="form-control text-center" id="id_ktp" name="id_ktp"
                value="{{ old('id_ktp') }}" required autofocus>
        </div>
    </form>
</div>

<a class="font-semibold mb-3 login-nik mt-4" href="{{ route('login.nik') }}">
    <h5 style="color: #166CDA">Login menggunakan NIK</h5>
</a>

@push('script')
    <script>
        let rfidBuffer = '';
        let timeout = null;

        document.addEventListener('keydown', function(e) {
            if (e.key.length === 1 || e.key === 'Enter') {
                if (timeout) clearTimeout(timeout);

                if (e.key === 'Enter') {
                    if (rfidBuffer.length > 0) {
                        document.getElementById('id_ktp').value = rfidBuffer;
                        document.getElementById('loginKtpForm').submit();
                        rfidBuffer = '';
                    }
                    return;
                }

                rfidBuffer += e.key;

                timeout = setTimeout(() => {
                    rfidBuffer = '';
                }, 1000);
            }
        });
    </script>
@endpush