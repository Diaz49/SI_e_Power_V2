@extends('templates.app')
@section('content')
    @push('style')
    @endpush
    <h4 class="text-primary fw-bolder fs-2 m-4">Data BAST (Berita Acara Serah Terima)</h4>
    <div id="datatable-section">
        <div class="d-flex justify-content-end">
            <div class="row ">
                <div class="col-12 d-flex justify-content-end mb-3 ">
                    <button class="btn btn-outline-secondary btn-sm me-4" data-bs-target="#modalTambah" data-bs-toggle="modal"
                        id="btn-tambah" style="--bs-btn-bg:white;"><i
                            class="fas fa-plus"></i> Tambah Data BAST                    
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

    <!-- Modal Tambah -->
    <form action="{{ route('bast.store') }}" method="POST">
        @csrf
        <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Bast</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <div class="mb-1 label">Tanggal</div>
                            <input type="date" class="form-control" name="tanggal" id="tanggal" value="{{ old('') }}"
                                placeholder="Masukkan Tanggal">
                            @error('tanggal')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror

                            <div class="mb-1 mt-2 label">Kode Invoice</div>
                            <select type="text" class="form-control js-example-basic-single" name="kd_invoice" id="kd_invoice"
                                value="" placeholder="Pilih Kode Invoice">
                                <option value="">Pilih Kode Invoice</option>
                                @foreach ($invoice as $item)
                                    <option value="{{ $item->id }}" >
                                        {{ $item->kd_invoice }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="mb-1 mt-2 label">PT</div>
                            <select type="text" class="form-control js-example-basic-single" name="nama_pt" id="nama_pt"
                                value="" placeholder="Masukkan Nama PT">
                                <option value="">Pilih PT</option>
                                @foreach ($pt as $item)
                                    <option value="{{ $item->id }}" >
                                        {{ $item->nama_pt }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="mb-1 label">Deskripsi</div>
                            <input type="text" class="form-control" name="deskripsi" id="deskripsi" value="{{ old('') }}"
                                placeholder="Masukkan Deskripsi">
                            @error('deskripsi')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <div class="mb-1 label">Nama</div>
                            <input type="text" class="form-control" name="nama" id="nama" value="{{ old('') }}"
                                placeholder="Masukkan Nama">
                            @error('nama')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <div class="mb-1 label">Jabatan</div>
                            <input type="text" class="form-control" name="jabatan" id="jabatan" value="{{ old('') }}"
                                placeholder="Masukkan Jabatan">
                            @error('jabatan')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <div class="mb-1 label">Jumlah item</div>
                            <input type="text" class="form-control" name="jumlah_item" id="jumlah_item" value="{{ old('') }}"
                                placeholder="Masukkan Jumlah Item">
                            @error('jumlah_item')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <div class="mb-1 label">Harga satuan</div>
                            <input type="text" class="form-control" name="harga_satuan" id="harga_satuan" value="{{ old('') }}"
                                placeholder="Masukkan Harga Satuan">
                            @error('harga_satuan')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <div class="mb-1 label">Total invoice</div>
                            <input type="text" class="form-control" name="total_invoice" id="total_invoice" value="{{ old('') }}"
                                placeholder="Masukkan Total Invoice" readonly>
                            @error('total_invoice')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
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
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data Bast</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div>
                            <div class="mb-1 label">Tanggal</div>
                            <input type="date" class="form-control" name="tanggal_edit" id="tanggal_edit" value="{{ old('') }}"
                                placeholder="Masukkan Tanggal">
                            @error('tanggal_edit')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror

                            <div class="mb-1 mt-2 label">Kode Invoice</div>
                            <select type="text" class="form-control js-example-basic-single" name="kd_invoice_edit" id="kd_invoice_edit"
                                value="" placeholder="Pilih Kode Invoice">
                                <option value="">Pilih Kode Invoice</option>
                                @foreach ($invoice as $item)
                                    <option value="{{ $item->id }}" >
                                        {{ $item->kd_invoice }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="mb-1 mt-2 label">PT</div>
                                <select type="text" class="form-control js-example-basic-single"
                                    name="nama_pt_edit" id="nama_pt_edit" value=""
                                    placeholder="Masukkan Nama PT">
                                    <option value="">Pilih PT</option>
                                    @foreach ($pt as $item)
                                        <option value="{{ $item->id }}">
                                            {{ $item->nama_pt }}
                                        </option>
                                    @endforeach
                                </select>
                            <div class="mb-1 label">Deskripsi</div>
                            <input type="text" class="form-control" name="deskripsi_edit" id="deskripsi_edit" value="{{ old('') }}"
                                placeholder="Masukkan Deskripsi">
                            @error('deskripsi_edit')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <div class="mb-1 label">Nama</div>
                            <input type="text" class="form-control" name="nama_edit" id="nama_edit" value="{{ old('') }}"
                                placeholder="Masukkan Nama">
                            @error('nama_edit')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <div class="mb-1 label">Jabatan</div>
                            <input type="text" class="form-control" name="jabatan_edit" id="jabatan_edit" value="{{ old('') }}"
                                placeholder="Masukkan Jabatan">
                            @error('jabatan_edit')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <div class="mb-1 label">Jumlah item</div>
                            <input type="text" class="form-control" name="jumlah_item_edit" id="jumlah_item_edit" value="{{ old('') }}"
                                placeholder="Masukkan Jumlah item">
                            @error('jumlah_item_edit')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <div class="mb-1 label">Harga satuan</div>
                            <input type="text" class="form-control" name="harga_satuan_edit" id="harga_satuan_edit" value="{{ old('') }}"
                                placeholder="Masukkan Harga satuan">
                            @error('harga_satuan_edit')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <div class="mb-1 label">Total invoice</div>
                            <input type="text" class="form-control" name="total_invoice_edit" id="total_invoice_edit" value="{{ old('') }}"
                                placeholder="Masukkan Total Invoice" readonly>
                            @error('total_invoice_edit')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

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

            $(document).on('click', 'a[data-bs-toggle="modal"]', function() {
                $('.error').remove(); // Hapus error sebelumnya
                var bast = $(this).data('id'); // Ambil ID dari tombol edit
                var url = '/bast/' + bast + '/edit'; // URL untuk ambil data
                var updateUrl = '/bast/' + bast; // URL untuk update data

                console.log('Client ID:', bast);

                // Request AJAX untuk mendapatkan data bast berdasarkan ID
                $.get(url, function(data) {
                    // Isi field modal dengan data yang didapat dari server
                    $('#tanggal_edit').val(data.tanggal);
                    $('#kd_invoice_edit').val(data.invoice_id).trigger('change');
                    $('#nama_pt_edit').val(data.pt_id).trigger('change');
                    $('#deskripsi_edit').val(data.deskripsi);
                    $('#nama_edit').val(data.nama);
                    $('#jabatan_edit').val(data.jabatan);
                    $('#jumlah_item_edit').val(data.jumlah_item);
                    $('#harga_satuan_edit').val(data.harga_satuan);
                    $('#total_invoice_edit').val(data.total_invoice);

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
                            if (errors.jumlah_item_edit) {
                                $('#jumlah_item_edit').after('<div class="text-danger error">' + errors
                                    .jumlah_item_edit[
                                        0] +
                                    '</div>');
                            }
                            if (errors.harga_satuan_edit) {
                                $('#harga_satuan_edit').after('<div class="text-danger error">' + errors
                                    .harga_satuan_edit[
                                        0] +
                                    '</div>');
                            }
                            if (errors.total_invoice_edit) {
                                $('#total_invoice_edit').after('<div class="text-danger error">' + errors
                                    .total_invoice_edit[
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

            $('#formTambah').on('submit', function(event) {
                event.preventDefault();
                // console.log('hai');
                var createUrl = '/bast';

                $.ajax({
                    url: createUrl,
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(result) {
                        $('#bast-table').DataTable().ajax.reload();
                        swal({
                            title: 'Berhasil!',
                            text: 'Data Bast berhasil di tambah',
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
                            if (errors.jumlah_item_edit) {
                                $('#jumlah_item_edit').after('<div class="text-danger error">' + errors
                                    .jumlah_item_edit[
                                        0] +
                                    '</div>');
                            }
                            if (errors.harga_satuan_edit) {
                                $('#harga_satuan_edit').after('<div class="text-danger error">' + errors
                                    .harga_satuan_edit[
                                        0] +
                                    '</div>');
                            }
                            if (errors.total_invoice_edit) {
                                $('#total_invoice_edit').after('<div class="text-danger error">' + errors
                                    .total_invoice_edit[
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
            $('#btn-tambah').on('click', function() {
                $('.error').remove();
                // $('#formTambah')[0].reset();
            })
        </script>
    @endpush

@endsection