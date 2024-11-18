@extends('templates.app')
@section('content')
    @push('style')
    @endpush
    <h4 class="text-primary fw-bolder fs-2 m-4">Data Project ID</h4>
    <div class="d-flex justify-content-end">
        <div class="row ">
            <div class="col-12 d-flex justify-content-end mb-3 ">
                <button class="btn btn-outline-secondary btn-sm me-4" data-bs-target="#modalTambah" data-bs-toggle="modal"
                    id="btn-tambah" style="--bs-btn-bg:white;"><i
                        class="fas fa-plus"></i> Data Project
                    ID</button>
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

    <!-- Modal Tambah -->
    <form action="{{ route('project-id.store') }}" method="POST" id="formTambah">
        @csrf
        <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Project ID</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-1 label">Project ID</div>
                        <input type="text" class="form-control" name="project_id" id="project_id" value=""
                            placeholder="Masukkan Project ID">
                        @error('project_id')
                            <div class="text-danger error">{{ $message }}</div>
                        @enderror

                        <div class="mb-1 mt-2 label">Nama Project</div>
                        <input type="text" class="form-control" name="nama_project" id="nama_project" value=""
                            placeholder="Masukkan Nama Project">
                        @error('nama_project')
                            <div class="text-danger error">{{ $message }}</div>
                        @enderror

                        <div class="mb-1 mt-2 label">Nama Client</div>
                        <input type="text" class="form-control" name="nama_client" id="nama_client" value=""
                            placeholder="Masukkan Nama Client">
                        @error('nama_client')
                            <div class="text-danger error">{{ $message }}</div>
                        @enderror

                        <div class="mb-1 mt-2 label">Alamat</div>
                        <textarea type="text" class="form-control" name="alamat" id="alamat" value=""
                            placeholder="Masukkan Alamat"></textarea>
                        @error('alamat')
                            <div class="text-danger error">{{ $message }}</div>
                        @enderror

                        <div class="mb-1 mt-2 label">HPP</div>
                        <input type="text" class="form-control" name="hpp" id="hpp" value=""
                            placeholder="Masukkan HPP">
                        @error('hpp')
                            <div class="text-danger error">{{ $message }}</div>
                        @enderror

                        <div class="mb-1 mt-2 label">RAB</div>
                        <input type="text" class="form-control" name="rab" id="rab" value=""
                            placeholder="Masukkan RAB">
                        @error('rab')
                            <div class="text-danger error">{{ $message }}</div>
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
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data Project ID</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-1 label">Project ID</div>
                        <input type="text" class="form-control" name="project_id_edit" id="project_id_edit"
                            value="" placeholder="Masukkan Project ID">
                        @error('project_id_edit')
                            <div class="error text-danger">{{ $message }}</div>
                        @enderror

                        <div class="mb-1 mt-2 label">Nama Project</div>
                        <input type="text" class="form-control" name="nama_project_edit" id="nama_project_edit"
                            value="" placeholder="Masukkan Nama Project">
                        @error('nama_project_edit')
                            <div class=" error text-danger">{{ $message }}</div>
                        @enderror

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

                        <div class="mb-1 mt-2 label">HPP</div>
                        <input type="text" class="form-control" name="hpp_edit" id="hpp_edit" value=""
                            placeholder="Masukkan HPP">
                        @error('hpp_edit')
                            <div class="text-danger error ">{{ $message }}</div>
                        @enderror

                        <div class="mb-1 mt-2 label">RAB</div>
                        <input type="text" class="form-control" name="rab_edit" id="rab_edit" value=""
                            placeholder="Masukkan RAB">
                        @error('rab_edit')
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
                    text: 'Apa kamu yakin ingin menghapus Project ' + name + '?',
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
                                    text: 'Project ' + name + ' berhasil dihapus',
                                    icon: 'success',
                                    button: 'OK'
                                });
                            },
                            error: function(xhr) {
                                // Menampilkan SweetAlert error jika gagal
                                swal({
                                    title: 'Gagal!',
                                    text: 'Gagal menghapus project',
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
                var projectId = $(this).data('id'); // Ambil ID dari tombol edit
                var url = '/project-id/' + projectId + '/edit'; // URL untuk ambil data
                var updateUrl = '/project-id/' + projectId; // URL untuk update data

                // Request AJAX untuk mendapatkan data project berdasarkan ID
                $.get(url, function(data) {
                    // Isi field modal dengan data yang didapat dari server
                    $('#project_id_edit').val(data.project_id);
                    $('#nama_project_edit').val(data.nama_project);
                    $('#nama_client_edit').val(data.nama_client);
                    $('#alamat_edit').val(data.alamat);
                    $('#hpp_edit').val(data.hpp);
                    $('#rab_edit').val(data.rab);

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
                        $('#dataprojectid-table').DataTable().ajax.reload();
                        swal({
                            title: 'Berhasil!',
                            text: 'Project berhasil diubah',
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
                            if (errors.project_id_edit) {
                                $('#project_id_edit').after('<div class="text-danger error">' + errors
                                    .project_id_edit[0] + '</div>');
                            }
                            if (errors.nama_project_edit) {
                                $('#nama_project_edit').after('<div class="text-danger error">' + errors
                                    .nama_project_edit[
                                        0] + '</div>');
                            }
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
                            if (errors.hpp_edit) {
                                $('#hpp_edit').after('<div class="text-danger error">' + errors.hpp_edit[
                                        0] +
                                    '</div>');
                            }
                            if (errors.rab_edit) {
                                $('#rab_edit').after('<div class="text-danger error">' + errors.rab_edit[
                                        0] +
                                    '</div>');
                            }
                        } else {
                            swal({
                                title: 'Gagal!',
                                text: 'Gagal mengedit project',
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
                var createUrl = '/project-id';

                $.ajax({
                    url: createUrl,
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(result) {
                        $('#dataprojectid-table').DataTable().ajax.reload();
                        swal({
                            title: 'Berhasil!',
                            text: 'Project berhasil ditambah',
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
                            if (errors.project_id) {
                                $('#project_id').after('<div class="text-danger error">' + errors
                                    .project_id[0] + '</div>');
                            }
                            if (errors.nama_project) {
                                $('#nama_project').after('<div class="text-danger error">' + errors
                                    .nama_project[
                                        0] + '</div>');
                            }
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
                            if (errors.hpp) {
                                $('#hpp').after('<div class="text-danger error">' + errors.hpp[
                                        0] +
                                    '</div>');
                            }
                            if (errors.rab) {
                                $('#rab').after('<div class="text-danger error">' + errors.rab[
                                        0] +
                                    '</div>');
                            }
                        } else {
                            swal({
                                title: 'Gagal!',
                                text: 'Gagal mengedit project',
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
