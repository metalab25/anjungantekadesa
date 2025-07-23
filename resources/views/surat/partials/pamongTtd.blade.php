<div class="row g-3 mb-3 align-items-start">
    <label for="pamong_ttd" class="col-md-4 col-form-label">
        Tertanda Atas Nama
    </label>
    <div class="col-md-8">
        <select name="pamong_ttd" id="pamong_ttd" class="form-select" readonly >
            @foreach ($data['pamongTtd'] as $pamong)
                @if ($pamong['jabatan'] === 'Kepala Desa')
                    <option value="0">
                        {{ $pamong['jabatan'] }} {{ $config->nama_desa }}
                    </option>
                @endif
            @endforeach
        </select>

        @error('pamong_ttd')
            <div class="invalid-feedback d-block">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>

<div class="row g-3 mb-3 align-items-start">
    <label for="id_pamong" class="col-md-4 col-form-label">
        Staf Pemerintah {{ $setting->sebutan_desa }}
    </label>
    <div class="col-md-8">
        <select name="id_pamong" id="id_pamong" class="form-select" readonly>
            @foreach ($data['stafDesa'] as $pamong)
                @if ($pamong['jabatan'] === 'Kepala Desa')
                    <option value="{{ $pamong['id'] }}"
                        data-jabatan="{{ $pamong['jabatan'] }}"
                        data-is-sekretaris="{{ $pamong['jabatan'] === 'Sekretaris Desa' ? '1' : '0' }}">
                        {{ $pamong['penduduk']['nama'] ?? $pamong['nama'] }} ({{ $pamong['jabatan'] }})
                    </option>
                @endif
            @endforeach
        </select>

        @error('id_pamong')
            <div class="invalid-feedback d-block">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>
