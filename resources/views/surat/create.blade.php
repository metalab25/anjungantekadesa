@extends('layouts.surat')

@section('title', 'Ajukan Surat – ' . ($data['formatSurat']['nama'] ?? 'Surat'))

@push('css')
    <style>
        .required-asterisk {
            color: #dc3545
        }

        /* tanda bintang merah */
    </style>
@endpush

@section('content')
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-lg-9 col-md-10">
                <div class="card shadow-sm">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Ajukan Surat {{ $data['formatSurat']['nama'] ?? '' }}</h5>
                        <a href="{{ url()->previous() }}" class="btn btn-outline-danger btn-sm">
                            <i class="bi bi-arrow-left me-1"></i> Kembali
                        </a>
                    </div>

                    <div class="card-body">
                        {{-- ========== FORM ========== --}}
                        <form action="{{ route('layanan.surat.ajukan', $data['formatSurat']['url_surat'] ?? '') }}"
                            method="POST" class="needs-validation" novalidate>
                            @csrf

                            <div class="form-group row mb-3">

                                <label for="no_surat" class="form-label col-md-3">Nomor Surat</label>

                                <div class="col-md-2">

                                    <div class="input-group">

                                        <input type="text" name="no_surat" id="no_surat"
                                            class="form-control @error('no_surat') is-invalid @enderror"
                                            value="{{ old('no_surat', $data['nomorSurat'] ?? '') }}" readonly>

                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <p class="pt-2 mb-0 text-danger text-sm">Format nomor surat:

                                        {{ $data['formatSurat']['kode_surat'] . '/' . ($data['nomorSurat'] - 1) . '/' . $setting->kode_surat . '/' . date('Y') }}

                                    </p>

                                </div>

                                @error('no_surat')
                                    <div class="invalid-feedback">

                                        {{ $message }}

                                    </div>
                                @enderror

                            </div>

                            {{-- ===== DATA PEMOHON (readonly) ===== --}}
                            <h6 class="fw-bold mb-3">Data Pemohon</h6>
                            <div class="row g-3">
                                <input type="text" hidden name="id_pend" value="{{ $user['penduduk_id'] }}">
                                <div class="col-md-8">
                                    <label class="form-label" for="nama_pend">Nama / NIK Penduduk</label>
                                    <input type="text" class="form-control" id="nama_pend"
                                        value="{{ $user['nama'] ?? $user['nik'] }}" readonly>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label" for="tempatlahir">Tempat Lahir</label>
                                    <input type="text" class="form-control" id="tempatlahir"
                                        value="{{ $user['tempat_lahir'] }}" readonly>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label" for="tanggallahir">Tanggal Lahir</label>
                                    <input type="text" class="form-control" id="tanggallahir"
                                        value="{{ $user['tanggal_lahir'] }}" readonly>
                                </div>

                                <div class="col-12">
                                    <label class="form-label" for="alamat">Alamat</label>
                                    <input type="text" class="form-control" name="alamat" id="alamat"
                                        value="{{ $user['alamat'] }}" readonly>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label" for="pendidikan_kk">Pendidikan</label>
                                    <input type="text" class="form-control" name="pendidikan_kk" id="pendidikan_kk"
                                        value="{{ $user['pendidikan'] }}" readonly>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label" for="warga_negara">Warga Negara</label>
                                    <input type="text" class="form-control" name="warga_negara" id="warga_negara"
                                        value="{{ $user['kewarganegaraan'] }}" readonly>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label" for="agama">Agama</label>
                                    <input type="text" class="form-control" name="agama" id="agama"
                                        value="{{ $user['agama'] }}" readonly>
                                </div>
                            </div>

                            {{-- ===== INPUT DINAMIS DARI formatSurat.kode_isian ===== --}}
                            @php
                                $fields = is_string($data['formatSurat']['kode_isian'] ?? '')
                                    ? json_decode($data['formatSurat']['kode_isian'], true)
                                    : $data['formatSurat']['kode_isian'] ?? [];
                            @endphp

                            @if ($fields)
                                <hr class="my-4">
                                <h6 class="fw-bold mb-3">Data Tambahan</h6>

                                @foreach ($fields as $item)
                                    @php
                                        $fieldId = Str::slug($item['kode'], '_');
                                        $isRequired = $item['required'] == '1' ? 'required' : '';
                                        $placeholder = $item['deskripsi'] ?: $item['nama'];
                                        $value = old($fieldId);
                                        $options = explode(',', $item['atribut'] ?? '');
                                    @endphp

                                    <div class="row g-3 align-items-start mb-3">
                                        <label for="{{ $fieldId }}" class="col-md-4 col-form-label">
                                            {{ $item['nama'] }}
                                            @if ($item['required'] == '1')
                                                <span class="required-asterisk">*</span>
                                            @endif
                                        </label>

                                        <div class="col-md-8">
                                            {{-- textarea --}}
                                            @if ($item['tipe'] === 'textarea')
                                                <textarea id="{{ $fieldId }}" name="{{ $fieldId }}" class="form-control" rows="3"
                                                    placeholder="{{ $placeholder }}" {{ $isRequired }}>{{ $value }}</textarea>

                                                {{-- select --}}
                                            @elseif ($item['tipe'] === 'select')
                                                <select id="{{ $fieldId }}" name="{{ $fieldId }}"
                                                    class="form-select" {{ $isRequired }}>
                                                    <option value="">Pilih {{ strtolower($item['nama']) }}</option>
                                                    @foreach ($options as $opt)
                                                        @php $optTrim = trim($opt); @endphp
                                                        <option value="{{ $optTrim }}"
                                                            {{ $value == $optTrim ? 'selected' : '' }}>
                                                            {{ $optTrim }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                                {{-- radio --}}
                                            @elseif ($item['tipe'] === 'radio')
                                                <div class="d-flex flex-wrap gap-3">
                                                    @foreach ($options as $idx => $opt)
                                                        @php
                                                            $radioId = $fieldId . '_' . $idx;
                                                            $optTrim = trim($opt);
                                                        @endphp
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio"
                                                                id="{{ $radioId }}" name="{{ $fieldId }}"
                                                                value="{{ $optTrim }}"
                                                                {{ $value == $optTrim ? 'checked' : '' }}
                                                                {{ $isRequired }}>
                                                            <label class="form-check-label" for="{{ $radioId }}">
                                                                {{ $optTrim }}
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>

                                                {{-- default: input type --}}
                                            @else
                                                <input type="{{ $item['tipe'] }}" id="{{ $fieldId }}"
                                                    name="{{ $fieldId }}" class="form-control"
                                                    placeholder="{{ $placeholder }}" value="{{ $value }}"
                                                    {{ $isRequired }}>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            @endif

                            {{-- ===== PERIODE BERLAKU ===== --}}
                            <hr class="my-4">
                            <div class="row g-3 mb-4">
                                <div class="col-md-4">
                                    <label>Berlaku Dari – Sampai</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="date" name="tgl_mulai" class="form-control"
                                        value="{{ date('Y-m-d') }}">
                                </div>
                                <div class="col-md-4">
                                    <input type="date" name="tgl_akhir" class="form-control"
                                        value="{{ date('Y-m-d', strtotime('+30 days')) }}" readonly>
                                </div>
                            </div>

                            {{-- ===== PEMILIHAN PENANDATANGAN ===== --}}
                            @include('surat.partials.pamongTtd')

                            {{-- ===== SUBMIT ===== --}}
                            <div class="d-grid d-md-flex justify-content-md-end">
                                <button type="submit" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#previewModal">
                                    <i class="bi bi-send me-1"></i> Cetak Surat
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
