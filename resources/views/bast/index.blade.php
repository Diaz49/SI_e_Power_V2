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
    {{-- <form action="{{ route('bast.store') }}" method="POST"> --}}
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
                        <input type="text" class="form-control" name="nama_bank" value="{{ old('') }}"
                            placeholder="Masukkan Nama Bank">
                        @error('nama_bank')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror

                        <div class="mb-1 mt-2 label">Nama Rek.</div>
                        <input type="text" class="form-control" name="nama_rek" value="{{ old('') }}"
                            placeholder="Masukkan Nama Rekening">
                        @error('nama_rek')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror

                        <div class="mb-1 mt-2 label">Nomer Rek.</div>
                        <input type="text" class="form-control" name="nomer_rek" value="{{ old('') }}"
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
@endsection