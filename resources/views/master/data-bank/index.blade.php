@extends('templates.app')
@section('content')
    @push('style')
    @endpush
    <h4 class="text-primary fw-bolder fs-2 m-4">Data Bank</h4>
    <div class="d-flex justify-content-end">
        <div class="row ">
            <div class="col-12 d-flex justify-content-end mb-3 ">
                <button class="btn btn-outline-secondary btn-sm me-4" data-bs-target="#modalTambah" data-bs-toggle="modal"><i
                        class="fas fa-plus"></i> Tambah Data Bank</button>
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
    <form action="{{ route('bank.store') }}" method="POST" id="formTambah">
        @csrf
        <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Bank</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-1 label">Nama Bank</div>
                        <input type="text" class="form-control" name="nama_bank" id="nama_bank" value="{{ old('') }}"
                            placeholder="Masukkan Nama Bank">
                        @error('nama_bank')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror

                        <div class="mb-1 mt-2 label">Nama Rek.</div>
                        <input type="text" class="form-control" name="nama_rek" id="nama_rek" value="{{ old('') }}"
                            placeholder="Masukkan Nama Rekening">
                        @error('nama_rek')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror

                        <div class="mb-1 mt-2 label">Nomer Rek.</div>
                        <input type="text" class="form-control" name="nomer_rek" id="nomer_rek" value="{{ old('') }}"
                            placeholder="Masukkan Nomer Rekening">
                        @error('nomer_rek')
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
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data Bank</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="mb-1 mt-2 label">Nama Bank</div>
                        <input type="text" class="form-control" name="nama_bank_edit" id="nama_bank_edit"
                            value="" placeholder="Masukkan Nama Bank">
                        @error('nama_bank_edit')
                            <div class="text-danger error ">{{ $message }}</div>
                        @enderror

                        <div class="mb-1 mt-2 label">Nama Rek.</div>
                        <input type="text" class="form-control" name="nama_rek_edit" id="nama_rek_edit" value=""
                            placeholder="Masukkan Nomer Rekening">
                        @error('nama_rek_edit')
                            <div class="text-danger error ">{{ $message }}</div>
                        @enderror

                        <div class="mb-1 mt-2 label">Nomer Rek.</div>
                        <input type="text" class="form-control" name="nomer_rek_edit" id="nomer_rek_edit" value=""
                            placeholder="Masukkan Nomer Rekening">
                        @error('nomer_rek_edit')
                            <div class="text-danger error ">{{ $message }}</div>
                        @enderror

                        <div class="mb-1 mt-2 label">Status</div>
                        <select class="form-control status-select" name="status_edit" id="status_edit">
                            <option value="use" {{ (isset($bank) && $bank->status === 'use') ? 'selected' : '' }}>Use</option>
                            <option value="not_use" {{ (isset($bank) && $bank->status === 'not_use') ? 'selected' : '' }}>Not Use</option>
                        </select>
                        @error('status_edit')
                            <div class="text-danger error">{{ $message }}</div>
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
                    text: 'Apa kamu yakin ingin menghapus Data Bank ini ' + name + '?',
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
                                    text: 'Data Bank ' + name + ' berhasil dihapus',
                                    icon: 'success',
                                    button: 'OK'
                                });
                            },
                            error: function(xhr) {
                                // Menampilkan SweetAlert error jika gagal
                                swal({
                                    title: 'Gagal!',
                                    text: 'Gagal menghapus Data Bank',
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
                var databank = $(this).data('id'); // Ambil ID dari tombol edit
                var url = '/bank/' + databank + '/edit'; // URL untuk ambil data
                var updateUrl = '/bank/' + databank; // URL untuk update data

                console.log('Client ID:', databank);

                // Request AJAX untuk mendapatkan data project berdasarkan ID
                $.get(url, function(data) {
                    // Isi field modal dengan data yang didapat dari server
                    $('#nama_bank_edit').val(data.nama_bank);
                    $('#nama_rek_edit').val(data.nama_rek);
                    $('#nomer_rek_edit').val(data.nomer_rek);
                    $('#status_edit').val(data.status);

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
                        $('#bank-table').DataTable().ajax.reload();
                        swal({
                            title: 'Berhasil!',
                            text: 'Data Bank berhasil diubah',
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
                            if (errors.nama_bank_edit) {
                                $('#nama_bank_edit').after('<div class="text-danger error">' + errors
                                    .nama_bank_edit[
                                        0] + '</div>');
                            }
                            if (errors.nama_rek_edit) {
                                $('#nama_rek_edit').after('<div class="text-danger error">' + errors
                                    .nama_rek_edit[
                                        0] +
                                    '</div>');
                            }
                            if (errors.nomer_rek_edit) {
                                $('#nomer_rek_edit').after('<div class="text-danger error">' + errors
                                    .nomer_rek_edit[
                                        0] +
                                    '</div>');
                            }
                            if (errors.status_edit) {
                                $('#status_edit').after('<div class="text-danger error">' + errors
                                    .status_edit[
                                        0] +
                                    '</div>');
                            }
                        } else {
                            swal({
                                title: 'Gagal!',
                                text: 'Gagal mengedit data bank',
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
                var createUrl = '/bank';

                $.ajax({
                    url: createUrl,
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(result) {
                        $('#bank-table').DataTable().ajax.reload();
                        swal({
                            title: 'Berhasil!',
                            text: 'Data Bank berhasil di tambah',
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
                            if (errors.nama_bank) {
                                $('#nama_bank').after('<div class="text-danger error">' + errors
                                    .nama_bank[
                                        0] + '</div>');
                            }
                            if (errors.nama_rek) {
                                $('#nama_rek').after('<div class="text-danger error">' + errors
                                    .nama_rek[
                                        0] +
                                    '</div>');
                            }
                            if (errors.nomer_rek) {
                                $('#nomer_rek').after('<div class="text-danger error">' + errors.nomer_rek[
                                        0] +
                                    '</div>');
                            }
                        } else {
                            swal({
                                title: 'Gagal!',
                                text: 'Gagal mengedit data bank',
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