@extends('template', [
    'title' => 'Laporan Kegiatan',
])

@section('content')
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="page-header-title">
                        <h5>Laporan Kegiatan</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            Rekapitulasi aktivitas yang telah dilaksanakan selama program magang.
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- [ breadcrumb ] end -->
    <!-- [ Main Content ] start -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-2 mb-md-0" style="max-width: 200px;" title="Daftar Kegiatan">
                        Filter Laporan Kegiatan
                    </h5>
                </div>
                <div class="card-body">
                    <form id="filterForm">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-md-5 mb-md-0">
                                <div class="form-group">
                                    <label for="dari_tanggal" class="col-form-label">
                                        Dari Tanggal
                                    </label>
                                    <input class="form-control" type="date" name="dari_tanggal"
                                        value="{{ now()->format('Y-m-d') }}" id="dari_tanggal">
                                </div>
                            </div>
                            <div class="col-12 col-md-5 mb-md-0">
                                <div class="form-group">
                                    <label for="sampai_tanggal" class="col-form-label">
                                        Sampai Tanggal
                                    </label>
                                    <input class="form-control" type="date" name="sampai_tanggal" id="sampai_tanggal">
                                </div>
                            </div>
                            <div class="col-12 col-md-2 d-flex align-items-center justify-content-center"
                                style="padding-top: 20px;">
                                <button type="button" id="tampilkanBtn" class="btn btn-light-primary w-100 w-md-auto">
                                    Tampilkan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-12" id="laporanCard" style="display:none;">
            <div class="card">
                <div class="card-header">
                    <button id="cetakBtn" class="btn btn-sm btn-light-success">
                        <i class="fas fa-print me-2"></i>Cetak Laporan
                    </button>
                </div>
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="kegiatanTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Uraian Kegiatan</th>
                                    <th>Hasil Kegiatan</th>
                                    <th>Kendala</th>
                                </tr>
                            </thead>
                            <tbody id="kegiatanTableBody">
                                <!-- Data akan diisi secara dinamis -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- [ Main Content ] end -->
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#tampilkanBtn').on('click', function() {
                $.ajax({
                    url: "{{ route('laporan.filter') }}",
                    method: 'POST',
                    data: $('#filterForm').serialize(),
                    success: function(response) {
                        let tableBody = $('#kegiatanTableBody');
                        tableBody.empty();

                        if (response.kegiatans.length > 0) {
                            response.kegiatans.forEach((kegiatan, index) => {
                                tableBody.append(`
                                <tr>
                                    <td>${index + 1}</td>
                                    <td>
                                        <span class="fw-bold">
                                            ${new Date(kegiatan.tanggal).toLocaleDateString('id-ID', {
                                                day: 'numeric',
                                                month: 'long',
                                                year: 'numeric'
                                            })}
                                        </span>
                                    </td>
                                    <td class="text-wrap">${kegiatan.uraian_kegiatan}</td>
                                    <td class="text-wrap">${kegiatan.hasil_kegiatan}</td>
                                    <td class="text-wrap">${kegiatan.kendala || 'Tidak ada kendala.'}</td>
                                </tr>
                            `);
                            });
                            $('#laporanCard').show();
                        } else {
                            tableBody.append(`
                            <tr>
                                <td colspan="5" class="text-center">Tidak ada data kegiatan</td>
                            </tr>
                        `);
                            $('#laporanCard').show();
                        }
                    }
                });
            });

            $('#cetakBtn').on('click', function() {
                // Ambil nilai dari form filter
                let dari_tanggal = $('#dari_tanggal').val();
                let sampai_tanggal = $('#sampai_tanggal').val();

                // Buat form baru
                let form = $('<form>', {
                    'action': "{{ route('laporan.cetak') }}",
                    'method': 'POST'
                });

                // Tambahkan input hidden
                form.append($('<input>', {
                    type: 'hidden',
                    name: 'dari_tanggal',
                    value: dari_tanggal
                }));

                form.append($('<input>', {
                    type: 'hidden',
                    name: 'sampai_tanggal',
                    value: sampai_tanggal
                }));

                // Tambahkan token CSRF
                form.append($('<input>', {
                    type: 'hidden',
                    name: '_token',
                    value: "{{ csrf_token() }}"
                }));

                // Tambahkan form ke body dan submit
                $('body').append(form);
                form.submit();
            });
        });
    </script>
@endpush
