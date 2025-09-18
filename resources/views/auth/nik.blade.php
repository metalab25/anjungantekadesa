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

<div class="card-body py-2">
    @if ($errors->any())
        <div class="alert alert-danger border-radius-lg">
            <ul class="mb-0 text-capitalize" style="list-style-type: none">
                @foreach ($errors->all() as $error)
                    <li class="text-white">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="form-wrapper"> {{-- <- wrapper biar center --}}
        <form method="POST" action="{{ route('login.auth') }}" class="mb-4" id="loginForm">
            @csrf
            <div class="form-group mb-5 mt-4">
                <div class="d-flex justify-content-center mb-3">
                    <img src="{{ $apiBase . '/storage/' . $config->logo }}" alt="Logo" width="100" class="img-fluid">
                </div>
                <h4 class="font-semibold mb-4 text-center">Masukkan NIK Anda</h4>
                <input type="number"
                    class="form-control @error('nik') is-invalid @enderror"
                    id="nik" name="nik" placeholder="Masukan NIK"
                    value="{{ old('nik') }}" required autofocus>
            </div>
            <div class="form-group mt-3 mb-5">
                <input type="password"
                    class="form-control @error('pin') is-invalid @enderror"
                    id="pin" name="pin" placeholder="Masukan PIN" required>
            </div>
            <button type="submit" class="btn btn-submit" disabled>MASUK</button>
        </form>

        <a class="font-semibold mb-4 login-ktp" href="{{ route('login.ktp') }}">
            <h5 style="color: #166CDA">Login menggunakan KTP</h5>
        </a>
    </div>
</div>


@push('script')
    <script>
        const nikInput = document.getElementById('nik');
        const pinInput = document.getElementById('pin');
        const submitBtn = document.querySelector('.btn-submit');

        function toggleSubmit() {
            if (nikInput.value.trim() !== '' && pinInput.value.trim() !== '') {
                submitBtn.disabled = false;
            } else {
                submitBtn.disabled = true;
            }
        }

        nikInput.addEventListener('input', toggleSubmit);
        pinInput.addEventListener('input', toggleSubmit);

        // kasih border merah kalau input invalid dari backend
        @if ($errors->has('nik'))
            nikInput.classList.add('is-invalid');
        @endif
        @if ($errors->has('pin'))
            pinInput.classList.add('is-invalid');
        @endif
    </script>
@endpush
