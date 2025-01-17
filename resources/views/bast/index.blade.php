@extends('templates.app')
@section('content')
    @push('style')
    @endpush
    <h4 class="text-primary fw-bolder fs-2 m-4">Data BAST (Berita Acara Serah Terima)</h4>
    <div id="datatable-section">
        <div class="d-flex justify-content-end">
            <div class="row ">

                <div class="col-12 d-flex justify-content-end">
                    <button class="btn btn-outline-secondary btn-sm " data-bs-target="#modalFilter" data-bs-toggle="modal"
                        style="--bs-btn-bg:white;"><i class="fas fa-filter"></i> Filter</button>
                    <button class="btn btn-outline-secondary btn-sm ms-3 me-4" onclick="exportClients()"
                        style="--bs-btn-bg:white;">
                        <i class="fas fa-download"></i> Export
                    </button>
                </div>

            </div>
        </div>
        <div class="card m-4">
            <div class="card-body">
                <div id="active-filters" class="d-flex"></div>
                <div class="table-responsive">
                    {!! $dataTable->table(['class' => 'display table table-hover table-responsive text-center ']) !!}

                </div>
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

                    <p class="fs-6 ">Pilih Tahun</p>
                    <div class="ps-3 pe-3">
                        <input type="radio" id="year_all" name="year" value="">
                        <label class="fw-bold pb-2" for="year_all">All</label><br>
                        @foreach ($years as $item)
                            <input type="radio" id="year_{{ $item }}" name="year" value="{{ $item }}">
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

    <!-- Modal Edit -->
    <form action="" method="POST" id="formEdit">
        @method('PUT')
        @csrf
        <div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data Bast</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body ps-4 me-2">

                        <div class="mb-1  label">Kode Invoice</div>
                        <select class="form-control" name="kd_invoice_edit" id="kd_invoice_edit" disabled>
                            <option value="">Pilih Kode Invoice</option>
                            @foreach ($invoice as $item)
                                <option value="{{ $item->id }}" data-nama-client="{{ $item->client->nama_client }}"
                                    data-deskripsi="{{ $item->header_deskripsi }}">
                                    {{ $item->kd_invoice }}
                                </option>
                            @endforeach
                        </select>
                        <!-- Input untuk menampilkan nama client -->
                        <input type="text" class="form-control mt-2" name="nama_client_edit" disabled
                            id="nama_client_edit" value="" placeholder="Nama Client">
                        <!-- Input untuk menampilkan deskripsi -->
                        <input type="text" class="form-control mt-2" name="deskripsi_invoice_edit" disabled
                            id="deskripsi_invoice_edit" value="" placeholder="Deskripsi">
                        <div class="mb-1 mt-2 label">Tanggal</div>
                        <input type="date" class="form-control" name="tanggal_edit" id="tanggal_edit"
                            placeholder="Masukkan Tanggal">

                        <div class="mb-1 mt-2 label">Nama</div>
                        <input type="text" class="form-control" name="nama_edit" id="nama_edit"
                            placeholder="Masukkan Nama">


                        <div class="mb-1 mt-2 label">Jabatan</div>
                        <input type="text" class="form-control" name="jabatan_edit" id="jabatan_edit"
                            placeholder="Masukkan Jabatan">
                    </div>
                    <div class="modal-footer">
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
                    text: 'Apa kamu yakin ingin menghapus Data Bast ini ' + name + '?',
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
                                    text: 'Data Bast ' + name + ' berhasil dihapus',
                                    icon: 'success',
                                    button: 'OK'
                                });
                            },
                            error: function(xhr) {
                                // Menampilkan SweetAlert error jika gagal
                                swal({
                                    title: 'Gagal!',
                                    text: 'Gagal menghapus Data Bast',
                                    icon: 'error',
                                    button: 'OK'
                                });
                            }
                        });
                    }
                });
            });

            // Fungsi untuk menghitung total invoice
            function updateTotalInvoiceEdit() {
                const jumlahItem = parseFloat($('#jumlah_item_edit').val()) || 0; // Ambil nilai jumlah item, default 0
                const hargaSatuan = parseFloat($('#harga_satuan_edit').val()) || 0; // Ambil nilai harga satuan, default 0
                const totalInvoice = jumlahItem * hargaSatuan; // Hitung total invoice
                $('#total_invoice_edit').val(totalInvoice.toFixed(2)); // Perbarui input total_invoice_edit dengan 2 desimal
            }

            // Fungsi untuk menghitung total invoice di modal tambah (jika ada)
            function updateTotalInvoiceTambah() {
                const jumlahItem = parseFloat($('#jumlah_item').val()) || 0;
                const hargaSatuan = parseFloat($('#harga_satuan').val()) || 0;
                const totalInvoice = jumlahItem * hargaSatuan;
                $('#total_invoice').val(totalInvoice.toFixed(2));
            }

            // Event listener untuk input pada modal edit
            $(document).on('input', '#jumlah_item_edit, #harga_satuan_edit', updateTotalInvoiceEdit);

            // Event listener untuk input pada modal tambah (jika ada input serupa)
            $(document).on('input', '#jumlah_item, #harga_satuan', updateTotalInvoiceTambah);

            $(document).on('click', '#btnEdit', function() {
                $('.error').remove(); // Hapus error sebelumnya
                var bast = $(this).data('id'); // Ambil ID dari tombol edit
                var url = '/bast/' + bast + '/edit'; // URL untuk ambil data
                var updateUrl = '/bast/' + bast; // URL untuk update data

                // Request AJAX untuk mendapatkan data bast berdasarkan ID
                $.get(url, function(data) {

                    // Isi field modal dengan data yang didapat dari server
                    $('#tanggal_edit').val(data.tanggal);
                    $('#kd_invoice_edit').val(data.invoice_id).trigger('change');
                    $('#nama_edit').val(data.nama);
                    $('#jabatan_edit').val(data.jabatan);

                    // Set URL action form pada modal
                    $('#formEdit').attr('action', updateUrl);
                });
            });

            $('#formEdit').on('submit', function(event) {
                event.preventDefault();
                $('#kd_invoice_edit').prop('disabled', false);
                var updateUrl = $(this).attr('action');
                console.log($(this).serialize()); // Debug data yang dikirim
                $.ajax({
                    url: updateUrl,
                    type: 'PUT',
                    data: $(this).serialize(),
                    success: function(result) {
                        $('#bast-table').DataTable().ajax.reload();
                        swal({
                            title: 'Berhasil!',
                            text: 'Data Bast berhasil diubah',
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
                            if (errors.tanggal_edit) {
                                $('#tanggal_edit').after('<div class="text-danger error">' + errors
                                    .tanggal_edit[
                                        0] + '</div>');
                            }
                            if (errors.deskripsi_edit) {
                                $('#deskripsi_edit').after('<div class="text-danger error">' + errors
                                    .deskripsi_edit[
                                        0] + '</div>');
                            }
                            if (errors.nama_edit) {
                                $('#nama_edit').after('<div class="text-danger error">' + errors
                                    .nama_edit[
                                        0] +
                                    '</div>');
                            }
                            if (errors.jabatan_edit) {
                                $('#jabatan_edit').after('<div class="text-danger error">' + errors
                                    .jabatan_edit[
                                        0] +
                                    '</div>');
                            }

                        } else {
                            swal({
                                title: 'Gagal!',
                                text: 'Gagal mengedit data bast',
                                icon: 'error',
                                button: 'OK'
                            });
                        }
                    }
                });
            });


            $(document).ready(function() {
                // console.log('Inisialisasi berjalan');
                $('#all').prop('checked', true);
                $('#year_all').prop('checked', true);



                $('#kd_invoice').select2({
                    dropdownParent: $('#modalTambah'),
                    width: '100%'
                });


                $('#kd_invoice_edit').on('change', function() {
                    var invoiceId = $(this).val(); // Ambil ID invoice
                    var invoiceData = $('#kd_invoice_edit option:selected')
                        .data(); // Ambil data dari opsi yang dipilih
                    console.log(invoiceData);
                    if (invoiceId) {
                        $('#nama_client_edit').val(invoiceData.namaClient); // Isi input nama_client_edit
                        $('#deskripsi_invoice_edit').val(invoiceData.deskripsi); // Isi input deskripsi
                    } else {
                        $('#nama_client_edit, #deskripsi_invoice_edit').val(''); // Kosongkan input
                    }
                });

            });

            function reloadDataTable() {
                // Ambil nilai radio button PT yang dipilih
                // Ambil nilai radio button Year yang dipilih
                let year = $('input[name="year"]:checked').val();
                let url = "{{ route('bast') }}";

                window.LaravelDataTables['bast-table'].ajax.url(
                        `${url}?tanggal=${year}`)
                    .load();
            }
            $('#filterBtn').on('click', function() {

                // Ambil filter Tahun yang dipilih
                const yearValue = $('input[name="year"]:checked').val();
                const yearLabel = $('input[name="year"]:checked').next('label').text();


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

                if (filterType === "year") {
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
                    text: 'Data Bast akan diunduh sebagai file Excel.',
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
                        window.location.href = '{{ route('bast.export') }}';
                    } else {
                        // Tampilkan pesan jika batal
                        swal('Batal!', 'Proses unduhan dibatalkan.', 'info');
                    }
                });
            }
        </script>
    @endpush
@endsection
