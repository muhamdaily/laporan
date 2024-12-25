@extends('template', [
    'title' => 'Kegiatan Harian',
])

@section('content')
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="page-header-title">
                        <h5>
                            Jurnal Aktivitas Harian
                        </h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            Catatan aktivitas sehari-hari selama menjalani program magang.
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- [ breadcrumb ] end -->
    <!-- [ Main Content ] start -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between flex-wrap flex-md-nowrap">
                        <!-- Judul -->
                        <h5 class="mb-2 mb-md-0" style="max-width: 200px;" title="Daftar Kegiatan">
                            Daftar Kegiatan
                        </h5>

                        <!-- Input dan Tombol -->
                        <div class="input-group input-group-sm w-100 w-md-auto" style="max-width: 300px;">
                            <!-- Input Pencarian -->
                            <input type="text" class="form-control" placeholder="Cari aktivitas harianmu"
                                id="search-custom">
                            <!-- Tombol Tambah Data -->
                            <button type="button" class="btn btn-info ms-2" data-bs-toggle="modal"
                                data-bs-target="#modal-tambah" title="Tambah Data Aktivitas">
                                <i class="fas fa-folder-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body table-border-style">
                    <div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="table-custom">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Tanggal</th>
                                        <th class="text-center">Uraian Kegiatan</th>
                                        <th class="text-center">Hasil Kegiatan</th>
                                        <th class="text-center">Kendala</th>
                                        <th class="text-center">
                                            <i class="fas fa-th"></i>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $kegiatan)
                                        <tr class="text-center">
                                            <td>
                                                {{ $loop->iteration }}
                                            </td>
                                            <td>
                                                <span class="fw-bold">
                                                    {{ \Carbon\Carbon::parse($kegiatan->tanggal)->translatedFormat('d F Y') }}
                                                </span>
                                            </td>
                                            <td class="text-wrap">
                                                {{ $kegiatan->uraian_kegiatan }}
                                            </td>
                                            <td class="text-wrap">
                                                {{ $kegiatan->hasil_kegiatan }}
                                            </td>
                                            <td class="text-wrap">
                                                @if ($kegiatan->kendala)
                                                    {{ $kegiatan->kendala }}
                                                @else
                                                    Tidak ada kendala.
                                                @endif
                                            </td>
                                            <td class="dropdown">
                                                <a class="dropdown-toggle arrow-none" data-bs-toggle="dropdown"
                                                    style="cursor: pointer;">
                                                    <i class="material-icons-two-tone">more_horiz</i>
                                                </a>

                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a href="{{ route('kegiatan.show', $kegiatan->id) }}"
                                                        class="dropdown-item">
                                                        <i class="material-icons-two-tone">visibility</i>
                                                        <span>Lihat Detail</span>
                                                    </a>

                                                    <a href="#" class="dropdown-item"
                                                        onclick="event.preventDefault();" data-bs-toggle="modal"
                                                        data-bs-target="#modal-ubah-{{ $kegiatan->id }}"
                                                        title="Ubah Data {{ $kegiatan->uraian_kegiatan }}">
                                                        <i class="material-icons-two-tone">edit</i>
                                                        <span>Ubah Kegiatan</span>
                                                    </a>

                                                    <div role="separator" class="dropdown-divider"></div>

                                                    <a href="javascript:void(0);" class="dropdown-item"
                                                        onclick="event.preventDefault(); document.getElementById('hapus-kegiatan-{{ $kegiatan->id }}').submit();">
                                                        <i class="material-icons-two-tone">delete</i>
                                                        <span>Hapus Kegiatan</span>
                                                    </a>

                                                    <form action="{{ route('kegiatan.destroy', $kegiatan->id) }}"
                                                        method="POST" id="hapus-kegiatan-{{ $kegiatan->id }}"
                                                        style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- [ Modal Tambah ] start -->
    <div id="modal-tambah" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
        aria-labelledby="modalTambahLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahLabel">
                        Tambah Jurnal Kegiatan
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('kegiatan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group date">
                                    <label class="form-label" for="tanggal">
                                        Tanggal Kegiatan <span class="text-danger">*</span>
                                    </label>

                                    <div class="input-group date">
                                        <input type="text" id="tanggal" name="tanggal"
                                            class="form-control @error('tanggal') is-invalid @enderror"
                                            placeholder="Pilih tanggal kegiatan" value="{{ old('tanggal') }}"
                                            autocomplete="off" />

                                        <span class="input-group-text">
                                            <i class="feather icon-calendar"></i>
                                        </span>
                                    </div>

                                    @error('tanggal')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label" for="uraian_kegiatan">
                                        Uraian Kegiatan <span class="text-danger">*</span>
                                    </label>

                                    <textarea id="uraian_kegiatan" name="uraian_kegiatan"
                                        class="form-control @error('uraian_kegiatan') is-invalid @enderror"
                                        placeholder="Isi dengan uraian kegiatan yang telah dilakukan" required>{{ old('uraian_kegiatan') }}</textarea>

                                    @error('uraian_kegiatan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label" for="hasil_kegiatan">
                                        Hasil Kegiatan <span class="text-danger">*</span>
                                    </label>

                                    <textarea id="hasil_kegiatan" name="hasil_kegiatan"
                                        class="form-control @error('hasil_kegiatan') is-invalid @enderror"
                                        placeholder="Isi dengan hasil dari kegiatan yang dilakukan" required>{{ old('hasil_kegiatan') }}</textarea>

                                    @error('hasil_kegiatan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <hr>

                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label" for="kendala">
                                        Kendala <small class="text-muted">
                                            (Isi jika ada kendala yang dihadapi selama kegiatan)
                                        </small>
                                    </label>

                                    <textarea id="kendala" name="kendala" class="form-control @error('kendala') is-invalid @enderror"
                                        placeholder="Isi dengan hasil dari kegiatan yang dilakukan">{{ old('kendala') }}</textarea>

                                    @error('kendala')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="files" class="form-label">
                                        Dokumen Pendukung <small class="text-muted">(Upload file pendukung jika
                                            diperlukan)</small>
                                    </label>

                                    <input class="form-control @error('files') is-invalid @enderror" type="file"
                                        id="files" name="files[]" multiple>

                                    @error('files')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                    <small class="text-primary">
                                        Tipe file yang dapat diunggah: <strong>
                                            .pdf, .docx, .xlsx, .pptx, .jpg, .jpeg, .png, .gif, .zip, .rar
                                        </strong>
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">
                            Tutup
                        </button>

                        <button type="submit" class="btn btn-sm btn-primary">
                            Simpan Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- [ Modal Tambah ] end -->

    <!-- [ Modal Ubah ] start -->
    @foreach ($data as $kegiatan)
        <div id="modal-ubah-{{ $kegiatan->id }}" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false"
            role="dialog" aria-labelledby="modalTambahLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTambahLabel">
                            Ubah Jurnal Kegiatan
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('kegiatan.update', $kegiatan->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group date">
                                        <label class="form-label" for="tanggal-{{ $kegiatan->id }}">
                                            Tanggal Kegiatan <span class="text-danger">*</span>
                                        </label>

                                        <div class="input-group date">
                                            <input type="text" id="tanggal-{{ $kegiatan->id }}" name="tanggal"
                                                class="form-control @error('tanggal') is-invalid @enderror"
                                                placeholder="Pilih tanggal kegiatan" value="{{ $kegiatan->tanggal }}" />

                                            <span class="input-group-text">
                                                <i class="feather icon-calendar"></i>
                                            </span>
                                        </div>

                                        @error('tanggal')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="uraian_kegiatan">
                                            Uraian Kegiatan <span class="text-danger">*</span>
                                        </label>

                                        <textarea id="uraian_kegiatan" name="uraian_kegiatan"
                                            class="form-control @error('uraian_kegiatan') is-invalid @enderror"
                                            placeholder="Isi dengan uraian kegiatan yang telah dilakukan" required>{{ $kegiatan->uraian_kegiatan }}</textarea>

                                        @error('uraian_kegiatan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="hasil_kegiatan">
                                            Hasil Kegiatan <span class="text-danger">*</span>
                                        </label>

                                        <textarea id="hasil_kegiatan" name="hasil_kegiatan"
                                            class="form-control @error('hasil_kegiatan') is-invalid @enderror"
                                            placeholder="Isi dengan hasil dari kegiatan yang dilakukan" required>{{ $kegiatan->hasil_kegiatan }}</textarea>

                                        @error('hasil_kegiatan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <hr>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="kendala">
                                            Kendala <small class="text-muted">
                                                (Isi jika ada kendala yang dihadapi selama kegiatan)
                                            </small>
                                        </label>

                                        <textarea id="kendala" name="kendala" class="form-control @error('kendala') is-invalid @enderror"
                                            placeholder="Isi dengan hasil dari kegiatan yang dilakukan">{{ $kegiatan->kendala }}</textarea>

                                        @error('kendala')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="files" class="form-label">
                                            Dokumen Pendukung <small class="text-muted">(Kosongkan jika tidak ingin
                                                mengubah dokumen yang sudah ada)</small>
                                        </label>

                                        <input class="form-control @error('files') is-invalid @enderror" type="file"
                                            id="files" name="files[]" multiple>

                                        @error('files')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                        <small class="text-primary">
                                            Tipe file yang dapat diunggah: <strong>
                                                .pdf, .docx, .xlsx, .pptx, .jpg, .jpeg, .png, .gif, .zip, .rar
                                            </strong>
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">
                                Tutup
                            </button>

                            <button type="submit" class="btn btn-sm btn-primary">
                                Simpan Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
    <!-- [ Modal Ubah ] end -->
    <!-- [ Main Content ] end -->
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/plugins/bootstrap-datepicker3.min.css') }}">

    <style>
        .dataTables_filter {
            display: none;
        }
    </style>
@endpush

@push('scripts')
    <script src="{{ asset('assets/dashboard/js/plugins/bootstrap-datepicker.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-datepicker/dist/locales/bootstrap-datepicker.id.min.js"></script>
    <script src="{{ asset('assets/custom/pages/kegiatan-harian.js') }}"></script>

    <script>
        $('#modal-tambah').on('shown.bs.modal', function() {
            $('#jenis_hadiah').select2({
                dropdownParent: $('#modal-tambah'),
                placeholder: "Pilih jenis hadiah",
                allowClear: true,
                minimumResultsForSearch: Infinity
            });
        });

        $('#modal-tambah').on('shown.bs.modal', function() {
            $('#status').select2({
                dropdownParent: $('#modal-tambah'),
                placeholder: "Pilih status",
                allowClear: true,
                minimumResultsForSearch: Infinity
            });
        });

        arrows = {
            leftArrow: '<i class="feather icon-chevron-left"></i>',
            rightArrow: '<i class="feather icon-chevron-right"></i>'
        }

        // Datepicker
        $('#tanggal').datepicker({
            todayHighlight: true,
            templates: arrows,
            format: 'yyyy-mm-dd',
            language: 'id'
        });

        @foreach ($data as $kegiatan)
            $('#tanggal-{{ $kegiatan->id }}').datepicker({
                todayHighlight: true,
                templates: arrows,
                format: 'yyyy-mm-dd',
                language: 'id'
            });
        @endforeach
    </script>
@endpush
