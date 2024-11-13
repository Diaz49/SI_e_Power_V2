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
                <button class="btn btn-outline-secondary btn-sm " onclick="return swal('Title', 'Text', 'success')"><i
                        class="fas fa-filter"></i> Filter</button>
                <button class="btn btn-outline-secondary btn-sm ms-3 me-4"><i class="fas fa-download"></i> Export</button>
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
    <form action="{{ route('data-client.store') }}" method="POST">
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
                        <input type="text" class="form-control" name="nama_client" value="{{ old('') }}"
                            placeholder="Masukkan Project ID">
                        {{-- @error('')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror --}}

                        <div class="mb-1 mt-2 label">Alamat</div>
                        <input type="text" class="form-control" name="alamat" value="{{ old('alamat') }}"
                            placeholder="Masukkan Alamat">
                        @error('alamat')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror

                        <div class="mb-1 mt-2 label">Invoice</div>
                        <input type="text" class="form-control" name="up_invoice" value="{{ old('') }}"
                            placeholder="Masukkan HPP">
                        {{-- @error('')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror --}}

                        <div class="mb-1 mt-2 label">SPH</div>
                        <input type="text" class="form-control" name="up_sph" value="{{ old('') }}"
                            placeholder="Masukkan RAB">
                        {{-- @error('rab')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror --}}

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
   {{-- <form action="{{ route('project-id.store') }}" method="POST">
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
                    <input type="text" class="form-control" name="project_id" value=""
                        placeholder="Masukkan Project ID">
                    @error('project_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <div class="mb-1 mt-2 label">Nama Project</div>
                    <input type="text" class="form-control" name="nama_project" value=""
                        placeholder="Masukkan Nama Project">
                    @error('nama_project')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <div class="mb-1 mt-2 label">Nama Client</div>
                    <input type="text" class="form-control" name="nama_client" value=""
                        placeholder="Masukkan Nama Client">
                    @error('nama_client')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <div class="mb-1 mt-2 label">Alamat</div>
                    <input type="text" class="form-control" name="alamat" value=""
                        placeholder="Masukkan Alamat">
                    @error('alamat')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <div class="mb-1 mt-2 label">HPP</div>
                    <input type="text" class="form-control" name="hpp" value=""
                        placeholder="Masukkan HPP">
                    @error('hpp')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <div class="mb-1 mt-2 label">RAB</div>
                    <input type="text" class="form-control" name="rab" value=""
                        placeholder="Masukkan RAB">
                    @error('rab')
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
</form> --}}

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
                    text: 'Apa kamu yakin ingin menghapus Project ini ' + name + '?',
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
        </script>
    @endpush
@endsection