@extends('templates.app')
@section('content')
    @push('style')
    @endpush
    <h4 class="text-primary fw-bolder fs-2 m-4">Data Client</h4>
    <div class="d-flex justify-content-end">
        <div class="row ">
            <div class="col-12 d-flex justify-content-end mb-3 ">
                <button class="btn btn-outline-secondary btn-sm me-4" data-bs-target="#modalTambah" data-bs-toggle="modal"><i
                        class="fas fa-plus"></i> Tambah Data Client</button>
            </div>
            <div class="col-12 d-flex justify-content-end">
                <button class="btn btn-outline-secondary btn-sm " data-bs-target="#modalFilter" data-bs-toggle="modal"
                        style="--bs-btn-bg:white;"><i class="fas fa-filter"></i> Filter</button>
                        <button class="btn btn-outline-secondary btn-sm ms-3 me-4" onclick="exportClients()">
                            <i class="fas fa-download"></i> Export
                        </button>
            </div>

        </div>
    </div>
    <div class="card m-4">
        <div class="card-body">
            <div id="active-filters" class="d-flex"></div>
            <div class="table-responsive">
                {!! $dataTable->table(['class' => 'display table table-hover table-responsive ']) !!}

            </div>
        </div>
    </div>

    {{-- Modal Filter --}}
    <div class="modal fade" id="modalFilter" tabindex="-1" aria-labelledby="modalFilterLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalFilterLabel">Select PT & Year</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="fs-6">Pilihan PT</p>
                    <div class="ps-3 pe-3">
                        <input type="radio" id="all" name="pt" value="">
                        <label class="fw-bold pb-2" for="all">All</label><br>
                        @foreach ($pt as $item)
                            <input type="radio" id="{{ $item->nama_pt }}" name="pt"
                                value="{{ $item->id }}">
                            <label class="fw-bold pb-2" for="{{ $item->nama_pt }}">{{ $item->nama_pt }}</label><br>
                        @endforeach


                    </div>
                    <p class="fs-6 pt-4">Pilih Tahun</p>
                    <div class="ps-3 pe-3">
                        <input type="radio" id="year_all" name="year" value="">
                        <label class="fw-bold pb-2" for="year_all">All</label><br>
                        @foreach ($years as $item)
                            <input type="radio" id="year_{{ $item }}" name="year"
                                value="{{ $item }}">
                            <label class="fw-bold pb-2" for="year_{{ $item }}">{{ $item }}</label><br>
                        @endforeach
                    </div>
                    <div class="w-100 d-flex justify-content-end mt-2">
                        <button type="button" id="filterBtn" class="btn btn-primary">OK</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah -->
    <form action="{{ route('data-client.store') }}" method="POST" id="formTambah">
        @csrf
        <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Client</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-1 label">Nama Client</div>
                        <input type="text" class="form-control" name="nama_client" id="nama_client" value="{{ old('') }}"
                            placeholder="Masukkan Nama Client">
                        @error('nama_client')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror

                        <div class="mb-1 mt-2 label">Alamat</div>
                        <input type="text" class="form-control" name="alamat" id="alamat" value="{{ old('alamat') }}"
                            placeholder="Masukkan Alamat">
                        @error('alamat')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror

                        <div class="mb-1 mt-2 label">No Telpon</div>
                        <input type="text" class="form-control" name="no_tlp" id="no_tlp" value="{{ old('no_tlp') }}"
                            placeholder="Masukkan Alamat">
                        @error('no_tlp')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror

                        <div class="mb-1 mt-2 label">Invoice</div>
                        <input type="text" class="form-control" name="up_invoice" id="up_invoice" value="{{ old('') }}"
                            placeholder="Masukkan Invoice">
                        @error('up_invoice')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror

                        <div class="mb-1 mt-2 label">SPH</div>
                        <input type="text" class="form-control" name="up_sph" id="up_sph" value="{{ old('') }}"
                            placeholder="Masukkan SPH">
                        @error('up_sph')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Tambah Data</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

   <!-- Modal Edit -->
   <form action="" method="POST" id="formEdit">
        @method('PUT')
        @csrf
        <div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data Client</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="mb-1 mt-2 label">Nama Client</div>
                        <input type="text" class="form-control" name="nama_client_edit" id="nama_client_edit"
                            value="" placeholder="Masukkan Nama Client">
                        @error('nama_client_edit')
                            <div class="text-danger error ">{{ $message }}</div>
                        @enderror

                        <div class="mb-1 mt-2 label">Alamat</div>
                        <textarea type="text" class="form-control" name="alamat_edit" id="alamat_edit" value=""
                            placeholder="Masukkan Alamat"></textarea>
                        @error('alamat_edit')
                            <div class="text-danger error ">{{ $message }}</div>
                        @enderror

                        <div class="mb-1 mt-2 label">No Telpon</div>
                        <textarea type="text" class="form-control" name="no_tlp_edit" id="no_tlp_edit" value=""
                            placeholder="Masukkan Alamat"></textarea>
                        @error('no_tlp_edit')
                            <div class="text-danger error ">{{ $message }}</div>
                        @enderror

                        <div class="mb-1 mt-2 label">Invoice</div>
                        <input type="text" class="form-control" name="up_invoice_edit" id="up_invoice_edit" value=""
                            placeholder="Masukkan Invoice">
                        @error('up_invoice_edit')
                            <div class="text-danger error ">{{ $message }}</div>
                        @enderror

                        <div class="mb-1 mt-2 label">SPH</div>
                        <input type="text" class="form-control" name="up_sph_edit" id="up_sph_edit" value=""
                            placeholder="Masukkan SPH">
                        @error('up_sph_edit')
                            <div class="text-danger error ">{{ $message }}</div>
                        @enderror

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Edit Data</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    @push('scripts')
        {{ $dataTable->scripts() }}
        <script>
            let selectedFilters = {};
            document.addEventListener('DOMContentLoaded', function() {
                @if (session('success'))
                    swal('Berhasil!', '{{ session('success') }}', 'success');
                @endif
            });

            $(document).on('click', 'button[data-action="delete"]', function() {
                var url = $(this).data('url');
                var tableId = $(this).data('table-id');
                var name = $(this).data('name');

                // Tampilkan SweetAlert konfirmasi
                swal({
                    text: 'Apa kamu yakin ingin menghapus Data Client ini ' + name + '?',
                    icon: 'warning',
                    buttons: {
                        cancel: 'Batal',
                        confirm: {
                            text: 'Ya, hapus',
                            value: true,
                            visible: true,
                            className: 'btn btn-danger',
                        }
                    },
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        // Jika user mengklik "Ya, hapus"
                        $.ajax({
                            url: url,
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}',
                            },
                            success: function(result) {
                                $('#' + tableId).DataTable().ajax.reload(); // Reload DataTable

                                // Menampilkan SweetAlert sukses
                                swal({
                                    title: 'Berhasil!',
                                    text: 'Data Client ' + name + ' berhasil dihapus',
                                    icon: 'success',
                                    button: 'OK'
                                });
                            },
                            error: function(xhr) {
                                // Menampilkan SweetAlert error jika gagal
                                swal({
                                    title: 'Gagal!',
                                    text: 'Gagal menghapus Data Client',
                                    icon: 'error',
                                    button: 'OK'
                                });
                            }
                        });
                    }
                });
            });
            $(document).on('click', 'a[data-bs-toggle="modal"]', function() {
                $('.error').remove(); // Hapus error sebelumnya
                var dataclient = $(this).data('id'); // Ambil ID dari tombol edit
                var url = '/data-client/' + dataclient + '/edit'; // URL untuk ambil data
                var updateUrl = '/data-client/' + dataclient; // URL untuk update data

                console.log('Client ID:', dataclient);

                // Request AJAX untuk mendapatkan data client berdasarkan ID
                $.get(url, function(data) {
                    // Isi field modal dengan data yang didapat dari server
                    $('#nama_client_edit').val(data.nama_client);
                    $('#alamat_edit').val(data.alamat);
                    $('#no_tlp_edit').val(data.no_tlp);
                    $('#up_invoice_edit').val(data.up_invoice);
                    $('#up_sph_edit').val(data.up_sph);

                    // Set URL action form pada modal
                    $('#formEdit').attr('action', updateUrl);
                });
            });

            $('#formEdit').on('submit', function(event) {
                event.preventDefault();
                var updateUrl = $(this).attr('action');
                console.log($(this).serialize()); // Debug data yang dikirim
                $.ajax({
                    url: updateUrl,
                    type: 'PUT',
                    data: $(this).serialize(),
                    success: function(result) {
                        $('#dataclient-table').DataTable().ajax.reload();
                        swal({
                            title: 'Berhasil!',
                            text: 'Data CLient berhasil diubah',
                            icon: 'success',
                            button: 'OK'
                        });
                        $('#modalEdit').modal('hide');
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) { // Error validasi
                            var errors = xhr.responseJSON.errors;

                            // Kosongkan pesan error lama sebelum menampilkan yang baru
                            $('.error').remove(); // Hapus error sebelumnya

                            // Menampilkan pesan error untuk masing-masing field
                            if (errors.nama_client_edit) {
                                $('#nama_client_edit').after('<div class="text-danger error">' + errors
                                    .nama_client_edit[
                                        0] + '</div>');
                            }
                            if (errors.alamat_edit) {
                                $('#alamat_edit').after('<div class="text-danger error">' + errors
                                    .alamat_edit[
                                        0] +
                                    '</div>');
                            }
                            if (errors.no_tlp_edit) {
                                $('#no_tlp_edit').after('<div class="text-danger error">' + errors
                                    .no_tlp_edit[
                                        0] +
                                    '</div>');
                            }
                            if (errors.up_invoice_edit) {
                                $('#up_invoice_edit').after('<div class="text-danger error">' + errors.up_invoice_edit[
                                        0] +
                                    '</div>');
                            }
                            if (errors.up_sph_edit) {
                                $('#up_sph_edit').after('<div class="text-danger error">' + errors.up_sph_edit[
                                        0] +
                                    '</div>');
                            }
                        } else {
                            swal({
                                title: 'Gagal!',
                                text: 'Gagal mengedit data client',
                                icon: 'error',
                                button: 'OK'
                            });
                        }
                    }
                });
            });

            $('#formTambah').on('submit', function(event) {
                event.preventDefault();
                console.log('hai');
                var createUrl = '/data-client';

                $.ajax({
                    url: createUrl,
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(result) {
                        $('#dataclient-table').DataTable().ajax.reload();
                        swal({
                            title: 'Berhasil!',
                            text: 'Data Client berhasil di tambah',
                            icon: 'success',
                            button: 'OK'
                        });
                        $('#modalTambah').modal('hide');
                        $('#formTambah')[0].reset();
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) { // Error validasi
                            var errors = xhr.responseJSON.errors;
                            console.log(errors);
                            // Kosongkan pesan error lama sebelum menampilkan yang baru
                            $('.error').remove(); // Hapus error sebelumnya

                            // Menampilkan pesan error untuk masing-masing field
                            if (errors.nama_client) {
                                $('#nama_client').after('<div class="text-danger error">' + errors
                                    .nama_client[
                                        0] + '</div>');
                            }
                            if (errors.alamat) {
                                $('#alamat').after('<div class="text-danger error">' + errors
                                    .alamat[
                                        0] +
                                    '</div>');
                            }
                            if (errors.no_tlp) {
                                $('#no_tlp').after('<div class="text-danger error">' + errors
                                    .no_tlp[
                                        0] +
                                    '</div>');
                            }
                            if (errors.up_invoice) {
                                $('#up_invoice').after('<div class="text-danger error">' + errors.up_invoice[
                                        0] +
                                    '</div>');
                            }
                            if (errors.up_sph) {
                                $('#up_sph').after('<div class="text-danger error">' + errors.up_sph[
                                        0] +
                                    '</div>');
                            }
                        } else {
                            swal({
                                title: 'Gagal!',
                                text: 'Gagal mengedit data client',
                                icon: 'error',
                                button: 'OK'
                            });
                        }
                    }
                });
            });
            $('#btn-tambah').on('click', function() {
                $('.error').remove();
                // $('#formTambah')[0].reset();
            })
            
            $(document).ready(function() {
                // console.log('Inisialisasi berjalan');
                $('#all').prop('checked', true);
                $('#year_all').prop('checked', true);
            });

            function reloadDataTable() {
                // Ambil nilai radio button PT yang dipilih
                let pt = $('input[name="pt"]:checked').val();
                // Ambil nilai radio button Year yang dipilih
                let year = $('input[name="year"]:checked').val();
                let url = "{{ route('data-client') }}";

                window.LaravelDataTables['dataclient-table'].ajax.url(
                        `${url}?created_at=${year}&pt_id=${pt}`)
                    .load();
            }
            $('#filterBtn').on('click', function() {
                const ptValue = $('input[name="pt"]:checked').val();
                const ptLabel = $('input[name="pt"]:checked').next('label').text();

                // Ambil filter Tahun yang dipilih
                const yearValue = $('input[name="year"]:checked').val();
                const yearLabel = $('input[name="year"]:checked').next('label').text();

                // Simpan filter PT jika dipilih
                if (ptValue !== undefined && ptValue !== "") {
                    selectedFilters.pt = {
                        value: ptValue,
                        label: ptLabel
                    };
                } else {
                    delete selectedFilters.pt; // Hapus jika tidak ada pilihan PT
                }

                // Simpan filter Tahun jika dipilih
                if (yearValue !== "") {
                    selectedFilters.year = {
                        value: yearValue,
                        label: yearLabel
                    };
                } else {
                    delete selectedFilters.year; // Hapus jika tidak ada pilihan Tahun
                }

                // Render badge untuk filter yang aktif
                renderBadges();
                reloadDataTable();
                $('#modalFilter').modal('hide');
            });
            // Fungsi untuk render badge filter aktif
            function renderBadges() {
                const container = $('#active-filters');
                container.empty(); // Kosongkan badge sebelumnya

                // Tambahkan badge untuk setiap filter aktif
                for (const key in selectedFilters) {
                    const filter = selectedFilters[key];
                    container.append(`
                    <span class=" bg-primary text-white rounded-pill py-1 ps-3 pe-2 d-flex align-items-center justify-content-center me-2 mb-3 fw-bold">
                        ${filter.label}
                        <button type="button" class="btn-close btn-close-white ms-2" aria-label="Close" onclick="removeFilter('${key}')"></button>
                    </span>
                `);
                }
            }
            // Fungsi untuk menghapus filter dari badge
            function removeFilter(filterType) {
                delete selectedFilters[filterType]; // Hapus filter dari daftar

                // Hapus pilihan pada elemen input/filter
                if (filterType === "pt") {
                    $('#all').prop('checked', true); // Reset pilihan radio PT
                } else if (filterType === "year") {
                    $('#year_all').prop('checked', true); // Reset pilihan select Tahun
                }

                // Render ulang badge
                renderBadges();

                // Update DataTable
                reloadDataTable();
            }
            function exportClients() {
                swal({
                    title: 'Apakah Anda yakin?',
                    text: 'Data klien akan diunduh sebagai file Excel.',
                    icon: 'warning',
                    buttons: {
                        cancel: {
                            text: 'Tidak',
                            value: null,
                            visible: true,
                            className: 'btn btn-danger',
                            closeModal: true,
                        },
                        confirm: {
                            text: 'Ya',
                            value: true,
                            visible: true,
                            className: 'btn btn-success',
                            closeModal: true,
                        }
                    }
                }).then((willDownload) => {
                    if (willDownload) {
                        // Lanjutkan ke proses unduh
                        window.location.href = '{{ route('data-client.export') }}';
                    } else {
                        // Tampilkan pesan jika batal
                        swal('Batal!', 'Proses unduhan dibatalkan.', 'info');
                    }
                });
            }
        </script>
    @endpush
@endsection