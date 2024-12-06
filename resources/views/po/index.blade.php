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

        <div class="row">
            <form class="col-md-6" id="formTambahDetail">
                @csrf
                <div class="card p-4">
                    <h5 class="card-title">Detail</h5>
                    <input type="text" class="form-control" name="po_id" id="po_id" hidden>

                    <div class="mb-1 mt-4 label">Nama Barang</div>
                    <input type="text" class="form-control" name="nama_barang" id="nama_barang" disabled value=""
                        placeholder="Masukkan Nama Barang">
                    @error('nama_barang')
                        <div class="text-danger error">{{ $message }}</div>
                    @enderror

                    <div class="mb-1 mt-2 label">Qty</div>
                    <input type="text" class="form-control" name="qty" id="qty" disabled value=""
                        placeholder="Masukkan Qty">
                    @error('qty')
                        <div class="text-danger error">{{ $message }}</div>
                    @enderror

                    <div class="mb-1 mt-2 label">Satuan</div>
                    <input type="text" class="form-control" name="satuan" id="satuan" disabled value=""
                        placeholder="Masukkan Satuan">
                    @error('satuan')
                        <div class="text-danger error">{{ $message }}</div>
                    @enderror

                    <div class="mb-1 mt-2 label">Harga Satuan</div>
                    <input type="text" class="form-control" name="harga_satuan" id="harga_satuan" disabled value=""
                        placeholder="Masukkan Harga Satuan">
                    @error('harga_satuan')
                        <div class="text-danger error">{{ $message }}</div>
                    @enderror

                    <div class="d-flex justify-content-end mt-3">
                        <button type="submit" id="btn_detail" disabled class="btn btn-primary">Add</button>
                    </div>


                </div>
            </form>
            <form class="col-md-6" method="POST" id="formTambahHeader">
                @csrf
                <div class="card p-4">
                    <h5 class="card-title">Header</h5>
                    <div class="mb-1 mt-4 label">Kode Purchase Order</div>
                    <input type="text" class="form-control" name="kode_purchase_order" id="kode_purchase_order"
                        value="" placeholder="Masukkan Kode Purchase Order">
                    @error('kode_purchase_order')
                        <div class="text-danger error">{{ $message }}</div>
                    @enderror

                    <div class="mb-1 mt-2 label">Tanggal</div>
                    <input type="date" class="form-control" name="tanggal" id="tanggal" value=""
                        placeholder="Pilih Tanggal">
                    @error('tanggal')
                        <div class="text-danger error">{{ $message }}</div>
                    @enderror

                    <div class="mb-1 mt-2 label">Nama Vendor</div>
                    <select type="text" class="form-control js-example-basic-single" name="nama_vendor" id="nama_vendor"
                        value="" placeholder="Masukkan Nama Vendor">
                        <option value="">Pilih Vendor</option>
                        @foreach ($vendor as $item)
                            <option value="{{ $item->id }}">{{ $item->nama_vendor }}</option>
                        @endforeach
                    </select>
                    @error('nama_vendor')
                        <div class="text-danger error">{{ $message }}</div>
                    @enderror

                    <div class="mb-1 mt-2 label">Nama Buyer</div>
                    <input type="text" class="form-control" name="nama_buyer" id="nama_buyer" value=""
                        placeholder="Masukkan Nama Buyer">
                    @error('nama_buyer')
                        <div class="text-danger error">{{ $message }}</div>
                    @enderror

                    <div class="mb-1 mt-2 label">Perihal</div>
                    <input type="text" class="form-control" name="perihal" id="perihal" value=""
                        placeholder="Masukkan Perihal">
                    @error('catatan')
                        <div class="text-danger error">{{ $message }}</div>
                    @enderror

                    <div class="mb-1 mt-2 label">Catatan</div>
                    <input type="text" class="form-control" name="catatan" id="catatan" value=""
                        placeholder="Masukkan Catatan">
                    @error('perihal')
                        <div class="text-danger error">{{ $message }}</div>
                    @enderror

                    <div class="mb-1 mt-2 label">Catatan 2</div>
                    <input type="text" class="form-control" name="catatan_2" id="catatan_2" value=""
                        placeholder="Masukkan Catatan 2">
                    @error('catatan_2')
                        <div class="text-danger error">{{ $message }}</div>
                    @enderror

                    <div class="mb-1 mt-2 label">Diskon Nominal Rupiah</div>
                    <input type="number" class="form-control" name="diskon_rupiah" id="diskon_rupiah" value=""
                        placeholder="Masukkan Diskon Nominal Rupiah">
                    @error('diskon_rupiah')
                        <div class="text-danger error">{{ $message }}</div>
                    @enderror

                    <div class="d-flex justify-content-end mt-3">
                        <button type="submit" id="btn_header" class="btn btn-primary">Tambah Data</button>
                    </div>

                </div>
            </form>
        </div>
        <div class=" d-md-flex justify-content-end">
            <button type="button" class="btn btn-secondary me-2" id="btn-cancel">Close</button>
        </div>

    </div>


    <!-- Modal Edit -->

    @push('scripts')
        {{ $dataTable->scripts() }}
        <script>
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
            $('#formTambahHeader').on('submit', function(event) {
                event.preventDefault();
                var createUrl = '/po';

                $.ajax({
                    url: createUrl,
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(result) {
                        $('#purchaseorder-table').DataTable().ajax.reload();

                        swal({
                            title: 'Berhasil!',
                            text: 'Header berhasil ditambah',
                            icon: 'success',
                            button: 'OK'
                        });

                        // Isi input ID dengan ID yang diterima dari response
                        $('#po_id').val(result.id);

                        // Disable form fields setelah berhasil
                        $('#kode_purchase_order').prop('disabled', true);
                        $('#tanggal').prop('disabled', true);
                        $('#nama_vendor').prop('disabled', true);
                        $('#nama_buyer').prop('disabled', true);
                        $('#perihal').prop('disabled', true);
                        $('#catatan').prop('disabled', true);
                        $('#catatan_2').prop('disabled', true);
                        $('#diskon_rupiah').prop('disabled', true);
                        $('#btn_header').prop('disabled', true);

                        $('#nama_barang').prop('disabled', false);
                        $('#qty').prop('disabled', false);
                        $('#satuan').prop('disabled', false);
                        $('#harga_satuan').prop('disabled', false);
                        $('#btn_detail').prop('disabled', false);
                        
                        $('.error').remove();
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) { // Error validasi
                            var errors = xhr.responseJSON.errors;
                            console.log(errors);

                            // Hapus pesan error sebelumnya
                            $('.error').remove();

                            // Menampilkan pesan error baru
                            if (errors.kode_purchase_order) {
                                $('#kode_purchase_order').after('<div class="text-danger error">' + errors
                                    .kode_purchase_order[0] + '</div>');
                            }
                            if (errors.tanggal) {
                                $('#tanggal').after('<div class="text-danger error">' + errors.tanggal[0] +
                                    '</div>');
                            }
                            if (errors.nama_vendor) {
                                $('#nama_vendor').after('<div class="text-danger error">' + errors
                                    .nama_vendor[0] + '</div>');
                            }
                            if (errors.nama_buyer) {
                                $('#nama_buyer').after('<div class="text-danger error">' + errors
                                    .nama_buyer[0] + '</div>');
                            }
                            if (errors.perihal) {
                                $('#perihal').after('<div class="text-danger error">' + errors.perihal[0] +
                                    '</div>');
                            }
                            if (errors.catatan) {
                                $('#catatan').after('<div class="text-danger error">' + errors.catatan[0] +
                                    '</div>');
                            }
                            if (errors.catatan_2) {
                                $('#catatan_2').after('<div class="text-danger error">' + errors.catatan_2[
                                    0] + '</div>');
                            }
                            if (errors.diskon_rupiah) {
                                $('#diskon_rupiah').after('<div class="text-danger error">' + errors
                                    .diskon_rupiah[0] + '</div>');
                            }
                        } else {
                            swal({
                                title: 'Gagal!',
                                text: 'Terjadi kesalahan dalam proses pengiriman data.',
                                icon: 'error',
                                button: 'OK'
                            });
                        }
                    }
                });
            });

            $('#formTambahDetail').on('submit', function(event) {
                event.preventDefault();
                var createUrl = '/po-detail';

                $.ajax({
                    url: createUrl,
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(result) {
                        swal({
                            title: 'Berhasil!',
                            text: 'Detail berhasil ditambah',
                            icon: 'success',
                            button: 'OK'
                        });

                        $('.error').remove();
                        // $('#modalTambah').modal('hide');
                        // $('#formTambah')[0].reset();
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) { // Error validasi
                            var errors = xhr.responseJSON.errors;
                            console.log(errors);
                            // Kosongkan pesan error lama sebelum menampilkan yang baru
                            $('.error').remove(); // Hapus error sebelumnya

                            if (errors.nama_barang) {
                                $('#nama_barang').after('<div class="text-danger error">' + errors
                                    .nama_barang[0] + '</div>');
                            }
                            if (errors.qty) {
                                $('#qty').after('<div class="text-danger error">' + errors
                                    .qty[0] + '</div>');
                            }
                            if (errors.satuan) {
                                $('#satuan').after('<div class="text-danger error">' + errors.satuan[0] +
                                    '</div>');
                            }
                            if (errors.harga_satuan) {
                                $('#harga_satuan').after('<div class="text-danger error">' + errors
                                    .harga_satuan[0] +
                                    '</div>');
                            }

                        } else {
                            swal({
                                title: 'Gagal!',
                                text: 'Terjadi kesalahan dalam proses pengiriman data.',
                                icon: 'error',
                                button: 'OK'
                            });
                        }
                    }

                });
            });

            $('#btn-tambah').on('click', function() {
                $('.error').remove();
                $('#formTambahHeader')[0].reset();
                $('#formTambahDetail')[0].reset();
                $('#nama_vendor').val(null).trigger('change'); // Reset Select2

                // $('#formTambah')[0].reset();
            })

            $(document).ready(function() {
                $('.js-example-basic-single').select2();
            });
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

            document.addEventListener('DOMContentLoaded', function() {
                const input1 = document.getElementById('id');
                const input2 = document.getElementById('detail_kode_po');

                // Event untuk mendeteksi perubahan pada Input 1
                input1.addEventListener('input', function() {
                    input2.value = input1.value; // Set nilai Input 2 sama dengan Input 1
                });
            });
        </script>
    @endpush
@endsection
