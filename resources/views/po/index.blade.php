@extends('templates.app')
@section('content')
    @push('style')
    @endpush
    <h4 class="text-primary fw-bolder fs-2 m-4">Data Purchase Order MPA</h4>
    <div id="datatable-section">
        <div class="d-flex justify-content-end">

            <div class="row ">
                <div class="col-12 d-flex justify-content-end mb-3 ">
                    <button class="btn btn-outline-secondary btn-sm me-4" id="btn-tambah" style="--bs-btn-bg:white;">
                        <i class="fas fa-plus"></i> Tambah Data
                    </button>
                </div>
                <div class="col-12 d-flex justify-content-end">
                    <button class="btn btn-outline-secondary btn-sm " onclick="return swal('Title', 'Text', 'success')"
                        style="--bs-btn-bg:white;"><i class="fas fa-filter"></i> Filter</button>
                    <button class="btn btn-outline-secondary btn-sm ms-3 me-4" style="--bs-btn-bg:white;"><i
                            class="fas fa-download"></i> Export</button>
                </div>

            </div>
        </div>

        <div class="card m-4">
            <div class="card-body">
                <div class="table-responsive">
                    {!! $dataTable->table(['class' => 'display table table-hover table-responsive ']) !!}

                </div>
            </div>
        </div>
    </div>

    <!-- Form Tambah -->
    <div id="form-section" style="display:none;" class="m-4 ">

        <form action="{{ route('data-vendor.store') }}" method="POST" id="formTambah">
            @csrf

            <div class="row">
                <div class="col-md-6">
                    <div class="card p-4">
                        <h5 class="card-title">Detail</h5>
                        <div class="mb-1 mt-4 label">Nama Barang</div>
                        <input type="text" class="form-control" name="nama_vendor" id="nama_vendor" value=""
                            placeholder="Masukkan Nama Vendor">
                        @error('nama_vendor')
                            <div class="text-danger error">{{ $message }}</div>
                        @enderror

                        <div class="mb-1 mt-2 label">Qty</div>
                        <input type="text" class="form-control" name="nama_vendor" id="nama_vendor" value=""
                            placeholder="Masukkan Nama Vendor">
                        @error('nama_vendor')
                            <div class="text-danger error">{{ $message }}</div>
                        @enderror

                        <div class="mb-1 mt-2 label">Satuan</div>
                        <input type="text" class="form-control" name="nama_vendor" id="nama_vendor" value=""
                            placeholder="Masukkan Nama Vendor">
                        @error('nama_vendor')
                            <div class="text-danger error">{{ $message }}</div>
                        @enderror

                        <div class="mb-1 mt-2 label">Harga Satuan</div>
                        <input type="text" class="form-control" name="nama_vendor" id="nama_vendor" value=""
                            placeholder="Masukkan Nama Vendor">
                        @error('nama_vendor')
                            <div class="text-danger error">{{ $message }}</div>
                        @enderror
                        <div class="d-flex justify-content-end mt-3">

                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>


                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card p-4">
                        <h5 class="card-title">Header</h5>
                        <div class="mb-1 mt-4 label">Kode Purchase Order</div>
                        <input type="text" class="form-control" name="kota" id="kota" value=""
                            placeholder="Masukkan Kota">
                        @error('kota')
                            <div class="text-danger error">{{ $message }}</div>
                        @enderror

                        <div class="mb-1 mt-2 label">Tanggal</div>
                        <input type="text" class="form-control" name="no_tlp" id="no_tlp" value=""
                            placeholder="Masukkan No Telpon">
                        @error('no_tlp')
                            <div class="text-danger error">{{ $message }}</div>
                        @enderror

                        <div class="mb-1 mt-2 label">Nama Vendor</div>
                        <input type="text" class="form-control" name="email" id="email" value=""
                            placeholder="Masukkan Email">
                        @error('email')
                            <div class="text-danger error">{{ $message }}</div>
                        @enderror

                        <div class="mb-1 mt-2 label">Nama Buyer </div>
                        <input type="text" class="form-control" name="up" id="up" value=""
                            placeholder="Masukkan up">
                        @error('up')
                            <div class="text-danger error">{{ $message }}</div>
                        @enderror
                        <div class="mb-1 mt-2 label">Catatan</div>
                        <input type="text" class="form-control" name="up" id="up" value=""
                            placeholder="Masukkan up">
                        @error('up')
                            <div class="text-danger error">{{ $message }}</div>
                        @enderror
                        <div class="mb-1 mt-2 label">Catatan 2 </div>
                        <input type="text" class="form-control" name="up" id="up" value=""
                            placeholder="Masukkan up">
                        @error('up')
                            <div class="text-danger error">{{ $message }}</div>
                        @enderror

                        <div class="mb-1 mt-2 label">Diskon Nominal Rupiah </div>
                        <input type="text" class="form-control" name="up" id="up" value=""
                            placeholder="Masukkan up">
                        @error('up')
                            <div class="text-danger error">{{ $message }}</div>
                        @enderror


                    </div>
                </div>
            </div>
            <div class=" d-md-flex justify-content-end">
                <button type="button" class="btn btn-secondary me-2" id="btn-cancel">Close</button>
                <button type="submit" class="btn btn-primary">Tambah Data</button>
            </div>
        </form>
    </div>

    <!-- Modal Edit -->

    @push('scripts')
        {{ $dataTable->scripts() }}
        <script>
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
                    text: 'Apa kamu yakin ingin menghapus Vendor ' + name + '?',
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
                                    text: 'Vendor ' + name + ' berhasil dihapus',
                                    icon: 'success',
                                    button: 'OK'
                                });
                            },
                            error: function(xhr) {
                                // Menampilkan SweetAlert error jika gagal
                                swal({
                                    title: 'Gagal!',
                                    text: 'Gagal menghapus Vendor',
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
                var vendorId = $(this).data('id'); // Ambil ID dari tombol edit
                var url = '/data-vendor/' + vendorId + '/edit'; // URL untuk ambil data
                var updateUrl = '/data-vendor/' + vendorId; // URL untuk update data

                // Request AJAX untuk mendapatkan data Vendor berdasarkan ID
                $.get(url, function(data) {
                    // Isi field modal dengan data yang didapat dari server
                    $('#nama_vendor_edit').val(data.nama_vendor);
                    $('#alamat_vendor_edit').val(data.alamat_vendor);
                    $('#kota_edit').val(data.kota);
                    $('#no_tlp_edit').val(data.no_tlp);
                    $('#email_edit').val(data.email);
                    $('#up_edit').val(data.up);

                    // Set URL action form pada modal
                    $('#formEdit').attr('action', updateUrl);
                });
            });

            $('#formEdit').on('submit', function(event) {
                event.preventDefault();
                var updateUrl = $(this).attr('action');

                $.ajax({
                    url: updateUrl,
                    type: 'PUT',
                    data: $(this).serialize(),
                    success: function(result) {
                        $('#datavendor-table').DataTable().ajax.reload();
                        swal({
                            title: 'Berhasil!',
                            text: 'Vendor berhasil diubah',
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
                            if (errors.nama_vendor_edit) {
                                $('#nama_vendor_edit').after('<div class="text-danger error">' + errors
                                    .nama_vendor_edit[0] + '</div>');
                            }
                            if (errors.alamat_vendor_edit) {
                                $('#alamat_vendor_edit').after('<div class="text-danger error">' + errors
                                    .alamat_vendor_edit[
                                        0] + '</div>');
                            }
                            if (errors.kota_edit) {
                                $('#kota_edit').after('<div class="text-danger error">' + errors.kota_edit[
                                    0] + '</div>');
                            }
                            if (errors.no_tlp_edit) {
                                $('#no_tlp_edit').after('<div class="text-danger error">' + errors
                                    .no_tlp_edit[
                                        0] +
                                    '</div>');
                            }
                            if (errors.email_edit) {
                                $('#email_edit').after('<div class="text-danger error">' + errors
                                    .email_edit[
                                        0] +
                                    '</div>');
                            }
                            if (errors.up_edit) {
                                $('#up_edit').after('<div class="text-danger error">' + errors.up_edit[
                                        0] +
                                    '</div>');
                            }
                        } else {
                            swal({
                                title: 'Gagal!',
                                text: 'Gagal mengedit Vendor',
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
                var createUrl = '/data-vendor';

                $.ajax({
                    url: createUrl,
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(result) {
                        $('#datavendor-table').DataTable().ajax.reload();
                        swal({
                            title: 'Berhasil!',
                            text: 'Vendor berhasil ditambah',
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
                            if (errors.nama_vendor) {
                                $('#nama_vendor').after('<div class="text-danger error">' + errors
                                    .nama_vendor[0] + '</div>');
                            }
                            if (errors.alamat_vendor) {
                                $('#alamat_vendor').after('<div class="text-danger error">' + errors
                                    .alamat_vendor[
                                        0] + '</div>');
                            }
                            if (errors.kota) {
                                $('#kota').after('<div class="text-danger error">' + errors
                                    .kota[
                                        0] + '</div>');
                            }
                            if (errors.no_tlp) {
                                $('#no_tlp').after('<div class="text-danger error">' + errors
                                    .no_tlp[
                                        0] +
                                    '</div>');
                            }
                            if (errors.email) {
                                $('#email').after('<div class="text-danger error">' + errors.email[
                                        0] +
                                    '</div>');
                            }
                            if (errors.up) {
                                $('#up').after('<div class="text-danger error">' + errors.up[
                                        0] +
                                    '</div>');
                            }
                        } else {
                            swal({
                                title: 'Gagal!',
                                text: 'Gagal mengedit Vendor',
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
            document.addEventListener('DOMContentLoaded', function() {
                const btnTambah = document.getElementById('btn-tambah');
                const btnCancel = document.getElementById('btn-cancel');
                const datatableSection = document.getElementById('datatable-section');
                const formSection = document.getElementById('form-section');

                // Event saat tombol tambah ditekan
                btnTambah.addEventListener('click', function() {
                    datatableSection.style.display = 'none'; // Sembunyikan DataTable
                    formSection.style.display = 'block'; // Tampilkan form
                });

                // Event saat tombol cancel ditekan
                btnCancel.addEventListener('click', function() {
                    formSection.style.display = 'none'; // Sembunyikan form
                    datatableSection.style.display = 'block'; // Tampilkan DataTable
                });
            });
        </script>
    @endpush
@endsection
