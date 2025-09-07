@extends('layouts.surat')

@section('title', 'Arsip Surat')

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <section class="pt-8">
        <div class="container">
            <h3 class="text-center font-poppins mb-4">Arsip Surat</h3>
            <div class="row justify-content-center">
                <div class="col-lg-11">
                    <table class="table table-hover text-center p-1 mb-0 bg-white">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Surat</th>
                                <th scope="col">Pamong</th>
                                <th scope="col">Jabatan Pamong</th>
                                <th scope="col">Status</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($arsip as $index => $item)
                                <tr>
                                    <th>{{ $index + 1 }}</th>
                                    <td>{{ $item['nama_surat'] }}</td>
                                    <td>{{ $item['pamong']['penduduk']['nama'] ?? '-' }}</td>
                                    <td> {{ $item['pamong']['jabatan'] ?? '-' }}</td>
                                    <td>{{ $item['status'] }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item['created_at'])->translatedFormat('d F Y') }}</td>
                                    <td>
                                        @if (isset($item['path']) &&
                                                ($item['status'] === 'Disetujui' ||
                                                    $item['status'] === 'Dicetak Oleh Operator' ||
                                                    $item['status'] === 'Sudah Diunduh' ||
                                                    $item['status'] === 'Cetak di Anjungan'))
                                            <a
                                                href="{{ env('DESA_API') . '/api/layanan-mandiri/arsip-surat/' . $item['id'] . '/download' }}">
                                                <i class="bi bi-download"></i>
                                            </a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7">Arsip Surat Kosong</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @include('layouts.copyright')
        </div>
        </div>
    </section>
@endsection
