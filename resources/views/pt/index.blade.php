@extends('templates.app')
@section('content')
    @push('style')
    @endpush
    <h4 class="text-primary fw-bolder fs-2 m-4">Data PT</h4>
    <div class="d-flex justify-content-end">
        <div class="row ">
            <div class="col-12 d-flex justify-content-end mb-3 ">
                <button class="btn btn-outline-secondary btn-sm me-4" data-bs-target="#modalTambah" data-bs-toggle="modal"><i
                        class="fas fa-plus"></i> Tambah Data PT</button>
            </div>
            {{-- <div class="col-12 d-flex justify-content-end">
                <button class="btn btn-outline-secondary btn-sm " onclick="return swal('Title', 'Text', 'success')"><i
                        class="fas fa-filter"></i> Filter</button>
                <button class="btn btn-outline-secondary btn-sm ms-3 me-4"><i class="fas fa-download"></i> Export</button>
            </div> --}}

        </div>
    </div>
    <div class="card m-4">
        <div class="card-body">
            <div class="table-responsive">
                {!! $dataTable->table(['class' => 'display table table-hover table-responsive ']) !!}

            </div>
        </div>
    </div>

    <!-- Modal Tambah -->
    <form action="{{ route('pt.store') }}" method="POST" id="formTambah">
        @csrf
        <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data PT</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-1 label">Nama PT</div>
                        <input type="text" class="form-control" name="nama_pt" id="nama_pt" value="{{ old('') }}"
                            placeholder="Masukkan Nama PT">
                        @error('nama_pt')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror

                        <div class="mb-1 mt-2 label">Kode PT</div>
                        <input type="text" class="form-control" name="kode_pt" id="kode_pt" value="{{ old('') }}"
                            placeholder="Masukkan Kode PT ">
                        @error('kode_pt')
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
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data PT</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="mb-1 mt-2 label">Nama PT</div>
                        <input type="text" class="form-control" name="nama_pt_edit" id="nama_pt_edit"
                            value="" placeholder="Masukkan Nama PT">
                        @error('nama_pt_edit')
                            <div class="text-danger error ">{{ $message }}</div>
                        @enderror

                        <div class="mb-1 mt-2 label">Kode PT</div>
                        <input type="text" class="form-control" name="kode_pt_edit" id="kode_pt_edit" value=""
                            placeholder="Masukkan Kode PT ">
                        @error('kode_pt_edit')
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
                    text: 'Apa kamu yakin ingin menghapus Data PT ini ' + name + '?',
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
                                    text: 'Data PT ' + name + ' berhasil dihapus',
                                    icon: 'success',
                                    button: 'OK'
                                });
                            },
                            error: function(xhr) {
                                // Menampilkan SweetAlert error jika gagal
                                swal({
                                    title: 'Gagal!',
                                    text: 'Gagal menghapus Data PT',
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
                var datapt = $(this).data('id'); // Ambil ID dari tombol edit
                var url = '/pt/' + datapt + '/edit'; // URL untuk ambil data
                var updateUrl = '/pt/' + datapt; // URL untuk update data

                console.log('Client ID:', datapt);

                // Request AJAX untuk mendapatkan data pt berdasarkan ID
                $.get(url, function(data) {
                    // Isi field modal dengan data yang didapat dari server
                    $('#nama_pt_edit').val(data.nama_pt);
                    $('#kode_pt_edit').val(data.kode_pt);

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
                        $('#pt-table').DataTable().ajax.reload();
                        swal({
                            title: 'Berhasil!',
                            text: 'Data PT berhasil diubah',
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
                            if (errors.nama_pt_edit) {
                                $('#nama_pt_edit').after('<div class="text-danger error">' + errors
                                    .nama_pt_edit[
                                        0] + '</div>');
                            }
                            if (errors.kode_pt_edit) {
                                $('#kode_pt_edit').after('<div class="text-danger error">' + errors
                                    .kode_pt_edit[
                                        0] +
                                    '</div>');
                            }
                           
                        } else {
                            swal({
                                title: 'Gagal!',
                                text: 'Gagal mengedit data pt',
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
                var createUrl = '/pt';

                $.ajax({
                    url: createUrl,
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(result) {
                        $('#pt-table').DataTable().ajax.reload();
                        swal({
                            title: 'Berhasil!',
                            text: 'Data PT berhasil di tambah',
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
                            if (errors.nama_pt) {
                                $('#nama_pt').after('<div class="text-danger error">' + errors
                                    .nama_pt[
                                        0] + '</div>');
                            }
                            if (errors.kode_pt) {
                                $('#kode_pt').after('<div class="text-danger error">' + errors
                                    .kode_pt[
                                        0] +
                                    '</div>');
                            }

                        } else {
                            swal({
                                title: 'Gagal!',
                                text: 'Gagal mengedit data pt',
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