@extends('layouts.surat')

@section('title', 'Ajukan Surat - ' . ($data['nama'] ?? 'Surat'))

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h4 class="pt-1 mb-0">Ajukan Surat {{ $data['nama'] ?? '' }}</h4>
                    <a class="btn btn-danger float-end">Kembali</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('layanan.surat.ajukan', $data['url_surat'] ?? '') }}" method="POST">
                    @csrf

                    {{-- Generate form field dari kode_isian --}}
                    @foreach ($data['kode_isian'] ?? [] as $field)
                    <div class="mb-3">
                        <label for="{{ $field['key'] ?? 'field' }}" class="form-label">
                            {{ $field['label'] ?? ucfirst($field['key'] ?? 'Field') }}
                        </label>
                        <input type="{{ $field['tipe'] ?? 'text' }}" class="form-control" id="{{ $field['key'] ?? '' }}" name="{{ $field['key'] ?? '' }}" placeholder="{{ $field['placeholder'] ?? '' }}" value="{{ old($field['key'] ?? '') }}" {{ ($field['required'] ?? false) ? 'required' : '' }}>
                    </div>
                    @endforeach
                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan Tambahan</label>
                        <input type="text" class="form-control" id="keterangan" name="keterangan" value="{{ old('keterangan') }}">
                    </div>

                    {{-- Field tambahan --}}

                    <button type="submit" class="btn btn-primary float-end">Ajukan Surat</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
