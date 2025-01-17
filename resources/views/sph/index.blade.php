@extends('templates.app')
@section('content')
    @push('style')
    @endpush
    <h4 class="text-primary fw-bolder fs-2 m-4">Data SPH (Surat Penawaran Harga)</h4>
    <div id="datatable-section">
        <div class="d-flex justify-content-end">
            <div class="row ">
                <div class="col-12 d-flex justify-content-end mb-3 ">
                    <button class="btn btn-outline-secondary btn-sm me-4" data-bs-target="#modalTambah" data-bs-toggle="modal"
                        id="btn-tambah" style="--bs-btn-bg:white;"><i class="fas fa-plus"></i> Tambah Data SPH
                    </button>
                </div>
                <div class="col-12 d-flex justify-content-end">
                    <button class="btn btn-outline-secondary btn-sm " data-bs-toggle="modal" data-bs-target="#modalFilter" style="--bs-btn-bg:white;"><i class="fas fa-filter"></i> Filter</button>
                    <button class="btn btn-outline-secondary btn-sm ms-3 me-4" onclick="exportClients()" style="--bs-btn-bg:white;">
                        <i class="fas fa-download"></i> Export
                    </button>
                </div>

            </div>
        </div>
        <div class="card m-4">
            <div class="card-body">
                <div id="active-filters" class="d-flex"></div>
                <div class="table-responsive">
                    {!! $dataTable->table(['class' => 'display table table-hover table-responsive text-center']) !!}

                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah -->
    <div id="form-section" style="display:none;" class="m-4 ">
        <div class=" d-md-flex justify-content-start">
            <p type="button" class="fw-bold" id="btn-cancel"><i class="fas fa-arrow-left"></i> Back</p>
        </div>
        @csrf
        <div class="row">
            <form class="col-md-6" id="formTambahDetail">
                @csrf
                <div class="card p-4">
                    <h5 class="card-title"><span class="badge rounded-circle bg-primary text-white ">
                            1
                        </span> Detail</h5>

                    <input type="text" class="form-control" name="sph_id" id="sph_id" hidden>

                    <div class="mb-1 mt-4 label">Project</div>
                    <input type="text" class="form-control" name="nama_project" id="nama_project" value=""
                        placeholder="Masukkan Project">

                    <div class="mb-1 mt-2 label">Qty</div>
                    <input type="text" class="form-control" name="qty" id="qty" value=""
                        placeholder="Masukkan Quantity">

                    <div class="mb-1 mt-2 label">Satuan</div>
                    <input type="text" class="form-control" name="satuan" id="satuan" value=""
                        placeholder="Masukkan Satuan">

                    <div class="mb-1 mt-2 label">Harga Satuan / Price</div>
                    <input type="text" class="form-control" name="harga_satuan" id="harga_satuan" value=""
                        placeholder="Masukkan Harga Satuan">

                    <div class="d-flex justify-content-end mt-3">
                        <button type="submit" id="btn_detail" class="btn btn-primary">Add</button>
                    </div>


                </div>
            </form>
            <form class="col-md-6" method="POST" id="formTambahHeader">
                @csrf
                <div class="card p-4">
                    <h5 class="card-title"><span class="badge rounded-circle bg-primary text-white fw-lighter">
                            2
                        </span> Header</h5>
                    <div class="mb-1 mt-4 label">Kode SPH</div>
                    <input type="text" class="form-control" name="kode_sph" id="kode_sph" value=""
                        placeholder="Masukkan Kode SPH">

                    <div class="mb-1 mt-2 label">Tanggal</div>
                    <input type="date" class="form-control" name="tanggal" id="tanggal" value=""
                        placeholder="Masukkan Tanggal">

                    <div class="mb-1 mt-2 label">Nama Client</div>
                    <select type="text" class="form-control js-example-basic-single" name="nama_client" id="nama_client"
                        value="" placeholder="Masukkan Data Client">
                        <option value="">Pilih Data Client</option>
                        @foreach ($dataclient as $item)
                            <option value="{{ $item->id }}" data-alamat="{{ $item->alamat }}"
                                data-up_sph="{{ $item->up_sph }}">{{ $item->nama_client }}
                            </option>
                        @endforeach
                    </select>
                    <input type="text" class="form-control" name="alamat_client" disabled id="alamat_client"
                        value="" placeholder="Alamat Data Client">
                    <input type="text" class="form-control" name="up_sph_client" disabled id="up_sph_client"
                        value="" placeholder="Up Sph Client">


                    <div class="mb-1 mt-2 label">Perihal Penawaran Harga</div>
                    <input type="text" class="form-control" name="penawaran_harga" id="penawaran_harga"
                        value="" placeholder="Masukkan Penawaran Harga">

                </div>

                <div class="d-flex justify-content-end mt-3">
                    <button type="submit" id="btn_header" class="btn btn-primary"><i class="far fa-save"></i>
                        Save</button>
                </div>

            </form>
        </div>

        {{-- Table --}}
        <div class="mt-4">
            <table class="table table-bordered" id="detailTable">
                <thead class="table-dark text-center">
                    <tr>
                        <th>No</th>
                        <th>Deskripsi Project</th>
                        <th>Qty</th>
                        <th>Satuan</th>
                        <th>Harga Satuan</th>
                        <th>Jumlah</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider text-center">
                    <!-- Data detail akan ditambahkan di sini -->
                </tbody>
            </table>
        </div>

    </div>

    <!-- Modal Edit Header -->
    <form action="" method="POST" id="formEditHeader">
        @method('PUT')
        @csrf
        <div class="modal fade" id="modalEditHeader" aria-labelledby="modalEditDetailLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalEditDetailLabel">Edit Data Header</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-1  label">Kode SPH</div>
                        <input type="text" class="form-control" name="edit_kode_sph" id="edit_kode_sph"
                            value="" placeholder="Masukkan Kode SPH">

                        <div class="mb-1 mt-2 label">Tanggal</div>
                        <input type="date" class="form-control" name="edit_tanggal" id="edit_tanggal" value=""
                            placeholder="Masukkan Tanggal">

                        <div class="mb-1 mt-2 label">Nama Client</div>
                        <select type="text" class="form-control js-example-basic-single" name="edit_nama_client"
                            id="edit_nama_client" value="" placeholder="Masukkan Data Client">
                            <option value="">Pilih Data Client</option>
                            @foreach ($dataclient as $item)
                                <option value="{{ $item->id }}" data-alamat="{{ $item->alamat }}"
                                    data-up_sph="{{ $item->up_sph }}">{{ $item->nama_client }}
                                </option>
                            @endforeach
                        </select>
                        <input type="text" class="form-control" name="edit_alamat_client" disabled
                            id="edit_alamat_client" value="" placeholder="Alamat Data Client">
                        <input type="text" class="form-control" name="edit_up_sph_client" disabled
                            id="edit_up_sph_client" value="" placeholder="Up Sph Client">


                        <div class="mb-1 mt-2 label">Perihal Penawaran Harga</div>
                        <input type="text" class="form-control" name="edit_penawaran_harga" id="edit_penawaran_harga"
                            value="" placeholder="Masukkan Penawaran Harga">

                        <div class="mb-1 mt-2 label">Kode Admin</div>
                        <input type="text" class="form-control" name="edit_kode_admin" id="edit_kode_admin"
                            value="" placeholder="Masukkan Kode Admin">


                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Edit Data</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Modal Edit Detail -->
    <div class="modal fade" id="modalEditDetail" tabindex="-1" aria-labelledby="modalEditDetailLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalEditDetailLabel">Edit Data Detail</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mt-4">
                        <table class="table table-bordered" id="detailEditTable">
                            <thead class="table-dark text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Deskripsi Project</th>
                                    <th>Qty</th>
                                    <th>Satuan</th>
                                    <th>Harga Satuan (Rp)</th>
                                    <th>Jumlah (Rp)</th>
                                    <th>Aksi</th>
                                </tr>

                            </thead>
                            <tbody class="table-group-divider text-center">
                                <!-- Data detail akan ditambahkan di sini -->
                            </tbody>
                        </table>
                        <div class="mt-2">
                            <strong>Total Keseluruhan: Rp <span id="totalHarga">0</span></strong>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="btnTambahDetail" data-bs-target="#modalAddItem" data-bs-toggle="modal"
                        class="btn btn-primary" data-add-sph-id="">Tambah Detail</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Add Item -->
    <form action="" method="POST" id="formAddItem">
        @method('POST')
        @csrf
        <div class="modal fade" id="modalAddItem" tabindex="-1" aria-labelledby="modalAddItemLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <p type="button" class="modal-title fw-bold me-2" id="btn-back" data-bs-toggle="modal"
                            data-bs-target="#modalEditDetail"><i class="fas fa-arrow-left"></i></p>
                        <h1 class="modal-title fs-5" id="modalAddItemLabel">Tambah Detail</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <input type="text" class="form-control" name="add_sph_id" id="add_sph_id" hidden>

                        <div class="mb-1 label">Deskripsi Project</div>
                        <input type="text" class="form-control" name="add_nama_project" id="add_nama_project"
                            value="" placeholder="Masukkan Nama Barang">


                        <div class="mb-1 mt-2 label">Qty</div>
                        <input type="text" class="form-control" name="add_qty" id="add_qty" value=""
                            placeholder="Masukkan Qty">


                        <div class="mb-1 mt-2 label">Satuan</div>
                        <input type="text" class="form-control" name="add_satuan" id="add_satuan" value=""
                            placeholder="Masukkan Satuan">


                        <div class="mb-1 mt-2 label">Harga Satuan</div>
                        <input type="text" class="form-control" name="add_harga_satuan" id="add_harga_satuan"
                            value="" placeholder="Masukkan Harga Satuan">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Tambah Data</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Modal Edit Item -->
    <form action="" method="POST" id="formEditItem">
        @method('PUT')
        @csrf
        <div class="modal fade" id="modalEditItem" tabindex="-1" aria-labelledby="modalEditItemLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <p type="button" class="modal-title fw-bold me-2" id="btn-back" data-bs-toggle="modal"
                            data-bs-target="#modalEditDetail"><i class="fas fa-arrow-left"></i></p>
                        <h1 class="modal-title fs-5" id="modalEditItemLabel">Edit Item</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="mb-1 label">Deskripsi</div>
                        <input type="text" class="form-control" name="edit_nama_project" id="edit_nama_project"
                            value="" placeholder="Masukkan Nama Barang">


                        <div class="mb-1 mt-2 label">Qty</div>
                        <input type="text" class="form-control" name="edit_qty" id="edit_qty" value=""
                            placeholder="Masukkan Qty">


                        <div class="mb-1 mt-2 label">Satuan</div>
                        <input type="text" class="form-control" name="edit_satuan" id="edit_satuan" value=""
                            placeholder="Masukkan Satuan">


                        <div class="mb-1 mt-2 label">Harga Satuan</div>
                        <input type="text" class="form-control" name="edit_harga_satuan" id="edit_harga_satuan"
                            value="" placeholder="Masukkan Harga Satuan">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Edit Item</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    {{-- Modal Filter --}}
    <div class="modal fade" id="modalFilter" tabindex="-1" aria-labelledby="modalFilterLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalFilterLabel">Select Year</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="fs-6">Pilih Tahun</p>
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
    @push('scripts')
        {{ $dataTable->scripts() }}
        <script>
            let detailArray = [];
            let no = 1;
            let selectedFilters = {};

            $(document).on('click', '#btnDeleteSph', function() {
                var url = $(this).data('url');
                var tableId = $(this).data('table-id');
                var name = $(this).data('name');

                // Tampilkan SweetAlert konfirmasi
                swal({
                    text: 'Apa kamu yakin ingin menghapus SPH ' + name + '?',
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
                                    text: 'SPH ' + name + ' berhasil dihapus',
                                    icon: 'success',
                                    button: 'OK'
                                });
                            },
                            error: function(xhr) {
                                // Menampilkan SweetAlert error jika gagal
                                swal({
                                    title: 'Gagal!',
                                    text: 'Gagal menghapus SPH',
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
                var sphId = $(this).data('id'); // Ambil ID dari tombol edit
                var url = '/data-sph/' + sphId + '/edit'; // URL untuk ambil data
                var updateUrl = '/data-sph/' + sphId; // URL untuk update data

                // Request AJAX untuk mendapatkan data project berdasarkan ID
                $.get(url, function(data) {
                    // Isi field modal dengan data yang didapat dari server
                    $('#edit_kode_sph').val(data.kode_sph);
                    $('#edit_tanggal').val(data.tanggal);
                    $('#edit_nama_client').val(data.data_client_id).trigger('change');
                    $('#edit_penawaran_harga').val(data.penawaran_harga);
                    $('#edit_kode_admin').val(data.kd_admin);

                    // Set URL action form pada modal
                    $('#formEditHeader').attr('action', updateUrl);
                });
            });

            $('#formTambahHeader').on('submit', function(event) {
                event.preventDefault();
                $('.error').remove();
                // Ambil data header dari form
                let headerData = $(this).serializeArray();
                let headerObj = {};
                headerData.forEach(item => {
                    headerObj[item.name] = item.value;
                });
                if (detailArray.length === 0) {
                    return swal({
                        title: 'Gagal!',
                        text: 'Tambah detail terlebih dahulu.',
                        icon: 'error',
                        button: 'OK'
                    });
                }
                // Gabungkan header dengan detail
                const dataToSend = {
                    header: headerObj,
                    details: detailArray, // detailArray sudah diisi sebelumnya
                };
                dataToSend._token = '{{ csrf_token() }}';
                // Kirim data menggunakan AJAX
                $.ajax({
                    url: '/data-sph', // URL endpoint untuk menyimpan data
                    type: 'POST',
                    data: JSON.stringify(dataToSend),
                    contentType: 'application/json', // Pastikan data dikirim dalam format JSON
                    success: function(response) {
                        swal({
                            title: 'Berhasil!',
                            text: 'Data purchase order berhasil disimpan!',
                            icon: 'success',
                            button: 'OK',
                        });
                        // Reset form dan tabel detail
                        $('#formTambahHeader')[0].reset();
                        $('#detailTable tbody').html('');
                        $('#sph-table').DataTable().ajax.reload();
                        $('.error').remove();
                        detailArray = [];
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) { // Error validasi
                            var errors = xhr.responseJSON.errors;

                            // Hapus pesan error sebelumnya
                            $('.error').remove();

                            // Menampilkan pesan error baru
                            if (errors['header.kode_sph']) {
                                $('#kode_sph').after('<div class="text-danger error">' + errors[
                                    'header.kode_sph'][0] + '</div>');
                            }
                            if (errors['header.tanggal']) {
                                $('#tanggal').after('<div class="text-danger error">' + errors[
                                    'header.tanggal'][0] + '</div>');
                            }
                            if (errors['header.nama_client']) {
                                $('#nama_client').after('<div class="text-danger error">' + errors[
                                    'header.nama_client'][0] + '</div>');
                            }
                            if (errors['header.penawaran_harga']) {
                                $('#penawaran_harga').after('<div class="text-danger error">' + errors[
                                    'header.penawaran_harga'][0] + '</div>');
                            }
                        }
                        if (xhr.status === 500) {
                            return swal({
                                title: 'Gagal!',
                                text: 'Terjadi kesalahan dalam menyimpan ke Database.',
                                icon: 'error',
                                button: 'OK'
                            });

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

                // Ambil nilai dari input
                const nama_project = $('#nama_project').val();
                const qty = $('#qty').val();
                const satuan = $('#satuan').val();
                const harga_satuan = $('#harga_satuan').val();
                const sph_id = $('#sph_id').val(); // Misalnya, ID SPH sudah ada di form
                const jumlah_harga = qty * harga_satuan;

                // Hapus pesan error sebelumnya
                $('.error').remove();

                // Validasi Nama Project
                if (!nama_project || nama_project.length === 0 || nama_project.length > 100) {
                    $('#nama_project').after(
                        '<div class="text-danger error">Nama barang harus diisi dan maksimal 100 karakter.</div>');
                    return;
                }

                // Validasi Quantity
                if (!qty || isNaN(qty) || qty < 1) {
                    $('#qty').after(
                        '<div class="text-danger error">Quantity harus berupa angka dan lebih besar dari 0.</div>');
                    return;
                }

                // Validasi Satuan
                if (!satuan || satuan.length > 50) {
                    $('#satuan').after(
                        '<div class="text-danger error">Satuan harus diisi dan maksimal 50 karakter.</div>');
                    return;
                }

                // Validasi Harga Satuan
                if (!harga_satuan || isNaN(harga_satuan) || harga_satuan < 0 || harga_satuan >
                    99999999999999999999.99) {
                    $('#harga_satuan').after(
                        '<div class="text-danger error">Harga satuan harus berupa angka .</div>'
                    );
                    return;
                }

                // Semua validasi lolos, lanjutkan menambah detail
                detailArray.push({
                    no,
                    sph_id,
                    nama_project,
                    qty,
                    satuan,
                    harga_satuan,
                    jumlah_harga
                });

                // Render data ke tabel
                var rowDetail = `
                <tr>
                    <td>${no++}</td>
                    <td>${nama_project}</td>
                    <td>${qty}</td>
                    <td>${satuan}</td>
                    <td>Rp. ${harga_satuan}</td>
                    <td class="jumlah">Rp. ${jumlah_harga}</td> <!-- Class 'jumlah' untuk mempermudah seleksi -->
                    <td>
                        <button class="btn btn-danger btn-sm btn-delete-detail" data-index="${detailArray.length - 1}">
                                    <i class="fas fa-trash"></i> 
                        </button>
                    </td>
                </tr>
                `;

                // Menambahkan row detail ke dalam tabel
                $('#detailTable tbody').append(rowDetail);

                // Panggil fungsi untuk menghitung dan menambahkan row subtotal
                calculateSubtotal();

                // Reset form input detail
                $('#formTambahDetail')[0].reset();

                swal({
                    title: 'Berhasil!',
                    text: 'Detail berhasil ditambahkan!',
                    icon: 'success',
                    button: 'OK',
                });
            });

            // Fungsi untuk menghitung subtotal
            function calculateSubtotal() {
                var total = 0;

                // Menjumlahkan semua nilai yang ada di kolom "Jumlah"
                $('#detailTable tbody .jumlah').each(function() {
                    var jumlah = $(this).text().replace('Rp. ', '').replace('.', '').replace(',',
                        ''); // Hapus format Rp dan koma
                    total += parseFloat(jumlah); // Tambahkan jumlah ke total
                });

                // Cek apakah row subtotal sudah ada, jika sudah dihapus dulu sebelum menambahkan yang baru
                if ($('#detailTable tbody .subtotal').length > 0) {
                    $('#detailTable tbody .subtotal').remove();
                }

                // Menambahkan row subtotal
                var subtotalRow = `
                <tr class="subtotal">
                    <td colspan="6" class=" fw-bold">Subtotal:</td>
                    <td  class="fw-bold">Rp. ${total.toLocaleString('id-ID')}</td> <!-- Format angka dengan Rupiah -->
                </tr>
                    `;

                // Menambahkan row subtotal
                $('#detailTable tbody').append(subtotalRow);
            }

            // Fungsi untuk menghapus baris detail dan update subtotal
            $(document).on('click', '.btn-delete-detail', function() {
                // Menghapus baris yang dipilih
                $(this).closest('tr').remove();

                // Menghitung ulang subtotal setelah baris dihapus
                calculateSubtotal();
            });

            $('#btn-tambah').on('click', function() {
                $('.error').remove();
                $('#formTambahHeader')[0].reset();
                $('#formTambahDetail')[0].reset();
                $('#nama_client').val(null).trigger('change');



                // $('#formTambah')[0].reset();
            })

            $(document).ready(function() {
                $('#year_all').prop('checked', true);
                $('#nama_client').select2();
                $('#edit_nama_client').select2({
                    dropdownParent: $('#modalEditHeader'),
                    width: '100%'
                });
                // Menangkap event change pada select2
                $('#nama_client').on('change', function() {
                    // Ambil ID client yang dipilih
                    var clientId = $(this).val();

                    // Cari data client berdasarkan ID (misalnya, dalam elemen data-* yang sudah ada di halaman)
                    var client = $('#nama_client option').filter(function() {
                        return $(this).val() == clientId;
                    }).data();

                    // Isi input dengan data yang sesuai
                    if (clientId) {
                        $('#alamat_client').val(client.alamat);
                        $('#up_sph_client').val(client.up_sph);
                    } else {
                        // Kosongkan input jika tidak ada client yang dipilih
                        $('#alamat_client, #up_sph_client').val('');
                    }
                });
                $('#edit_nama_client').on('change', function() {
                    // Ambil ID client yang dipilih
                    var clientId = $(this).val();

                    // Cari data client berdasarkan ID (misalnya, dalam elemen data-* yang sudah ada di halaman)
                    var client = $('#edit_nama_client option').filter(function() {
                        return $(this).val() == clientId;
                    }).data();

                    // Isi input dengan data yang sesuai
                    if (clientId) {
                        $('#edit_alamat_client').val(client.alamat);
                        $('#edit_up_sph_client').val(client.up_sph);
                    } else {
                        // Kosongkan input jika tidak ada client yang dipilih
                        $('#edit_alamat_client, #edit_up_sph_client')
                            .val('');
                    }
                });

            });

            // document.addEventListener('DOMContentLoaded', function() {
            //     const btnTambah = document.getElementById('btn-tambah');
            //     const btnCancel = document.getElementById('btn-cancel');
            //     const datatableSection = document.getElementById('datatable-section');
            //     const formSection = document.getElementById('form-section');

            //     // Cek status tampilan yang disimpan di localStorage
            //     const isFormVisible = localStorage.getItem('formVisible') === 'true';

            //     // Jika formSection harus ditampilkan berdasarkan localStorage, tampilkan form
            //     if (isFormVisible) {
            //         datatableSection.style.display = 'none'; // Sembunyikan DataTable
            //         formSection.style.display = 'block'; // Tampilkan form
            //     } else {
            //         datatableSection.style.display = 'block'; // Tampilkan DataTable
            //         formSection.style.display = 'none'; // Sembunyikan form
            //     }

            //     // Event saat tombol tambah ditekan
            //     btnTambah.addEventListener('click', function() {
            //         datatableSection.style.display = 'none'; // Sembunyikan DataTable
            //         formSection.style.display = 'block'; // Tampilkan form

            //         // Simpan status form terlihat di localStorage
            //         localStorage.setItem('formVisible', 'true');
            //     });

            //     // Event saat tombol cancel ditekan
            //     btnCancel.addEventListener('click', function() {
            //         formSection.style.display = 'none'; // Sembunyikan form
            //         datatableSection.style.display = 'block'; // Tampilkan DataTable

            //         // Simpan status form tidak terlihat di localStorage
            //         localStorage.setItem('formVisible', 'false');
            //     });
            // }); // kepake buat pindah halaman dan permanen

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
                const input2 = document.getElementById('detail_kode_sph');

                // Event untuk mendeteksi perubahan pada Input 1
                input1.addEventListener('input', function() {
                    input2.value = input1.value; // Set nilai Input 2 sama dengan Input 1
                });
            });

            $(document).on('click', '.btn-delete-detail', function() {
                const index = $(this).data('index');
                detailArray.splice(index, 1); // Hapus dari array
                $(this).closest('tr').remove(); // Hapus dari tabel
            });

            $('#formEditHeader').on('submit', function(event) {
                event.preventDefault();
                var updateUrl = $(this).attr('action');

                $.ajax({
                    url: updateUrl,
                    type: 'PUT',
                    data: $(this).serialize(),
                    success: function(result) {
                        $('#sph-table').DataTable().ajax.reload();
                        swal({
                            title: 'Berhasil!',
                            text: 'Header berhasil diubah',
                            icon: 'success',
                            button: 'OK'
                        });
                        $('#modalEditHeader').modal('hide');
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) { // Error validasi
                            var errors = xhr.responseJSON.errors;

                            // Kosongkan pesan error lama sebelum menampilkan yang baru
                            $('.error').remove(); // Hapus error sebelumnya

                            // Menampilkan pesan error untuk masing-masing field
                            if (errors.edit_kode_sph) {
                                $('#edit_kode_sph').after('<div class="text-danger error">' +
                                    errors
                                    .edit_kode_sph[0] + '</div>');
                            }
                            if (errors.edit_tanggal) {
                                $('#edit_tanggal').after('<div class="text-danger error">' + errors
                                    .edit_tanggal[
                                        0] + '</div>');
                            }
                            if (errors.edit_nama_client) {
                                $('#edit_nama_client').after('<div class="text-danger error">' + errors
                                    .edit_nama_client[
                                        0] + '</div>');
                            }
                            if (errors.edit_penawaran_harga) {
                                $('#edit_penawaran_harga').after('<div class="text-danger error">' + errors
                                    .edit_penawaran_harga[
                                        0] +
                                    '</div>');
                            }
                        } else {
                            swal({
                                title: 'Gagal!',
                                text: 'Gagal mengedit Header',
                                icon: 'error',
                                button: 'OK'
                            });
                        }
                    }
                });
            });

            $(document).on('click', '#btnEditDetail', function() {
                let sphId = $(this).data('id'); // Ambil ID PO dari tombol
                $('#btnTambahDetail').attr('data-add-sph-id', sphId);


                // AJAX request untuk mengambil data detail
                $.ajax({
                    url: `/sph-detail/${sphId}/edit`, // Endpoint untuk method edit
                    type: 'GET',
                    success: function(response) {
                        // Kosongkan tabel sebelum menambahkan data baru
                        $('#detailEditTable tbody').empty();

                        // Loop data detail dan tambahkan ke tabel
                        response.detailSph.forEach((detailSph, index) => {
                            $('#detailEditTable tbody').append(`
                    <tr id="row-${detailSph.id}">
                        <td>${index + 1}</td>
                        <td>${detailSph.nama_project}</td>
                        <td>${detailSph.qty}</td>
                        <td>${detailSph.satuan}</td>
                        <td>${Math.floor(detailSph.harga_satuan)}</td>
                        <td>${Math.floor(detailSph.jumlah_harga)}</td>
                    <td>
                        <div class="dropdown">
                        <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false"
                            style="--bs-btn-active-border-color:transparent;">
                            <i class="fas fa-ellipsis-h"></i>
                        </button>
                        <ul class="dropdown-menu">
                        
                            <li><a href="javascript:void(0)" id="btnEditItem"  class="dropdown-item text-info fw-bold d-flex justify-content-between py-2"
                                    data-id="${detailSph.id}" data-po-id="${sphId}" type="button" data-bs-toggle="modal" data-bs-target="#modalEditItem">Edit Detail<i
                                        class="ml-4 fas fa-pen"></i></a></li>
                            <li>
                                <button class="dropdown-item text-danger fw-bold d-flex justify-content-between py-2" id="btnDeleteDetailItem" type="button"
                                    data-table-id="purchaseorder-table" data-url="sph-detail/delete/${detailSph.id}" data-id="${detailSph.id}"
                                    data-name="${detailSph.nama_project}" data-action="delete">
                                    Delete <i class="fas fa-trash"></i>
                                </button>

                            </li>
                        </ul>
                    </div>

                    </td>
                    </tr>
                `);
                        });
                        updateTotalHarga();

                        // Tampilkan modal
                        $('#modalEditDetail1').modal('show');
                    },
                    error: function() {
                        alert('Gagal mengambil data detail.');
                    }
                });
            });

            $(document).on('click', '#btnDeleteDetailItem', function() {
                var url = $(this).data('url');
                var itemId = $(this).data('id');
                var name = $(this).data('name');

                // Tampilkan SweetAlert konfirmasi
                swal({
                    text: 'Apa kamu yakin ingin menghapus item ' + name + '?',
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
                                swal({
                                    title: 'Berhasil!',
                                    text: 'Item ' + name + ' berhasil dihapus',
                                    icon: 'success',
                                    button: 'OK'
                                }).then(() => {
                                    $('#row-' + itemId).remove(); // Hapus baris dari DOM
                                    updateTotalHarga();

                                    // Update penomoran ulang
                                    $('#detailEditTable tbody tr').each(function(index) {
                                        $(this).find('td:first').text(index +
                                            1); // Kolom pertama diupdate
                                    });

                                    $('#sph-table').DataTable().ajax
                                        .reload(); // Reload DataTable jika diperlukan

                                });
                            },
                            error: function(xhr) {
                                // Menampilkan SweetAlert error jika gagal
                                swal({
                                    title: 'Gagal!',
                                    text: 'Gagal menghapus item detail',
                                    icon: 'error',
                                    button: 'OK'
                                });
                            }
                        });
                    }
                });
            });

            $(document).on('click', '#btnEditItem', function() {

                $('.error').remove(); // Hapus error sebelumnya
                var itemId = $(this).data('id'); // Ambil ID dari tombol edit
                var sphId = $(this).data('sph-id'); // Ambil ID dari tombol edit
                var url = '/sph-item/' + itemId + '/edit'; // URL untuk ambil data
                var updateUrl = '/sph-item/' + itemId; // URL untuk update data

                // Request AJAX untuk mendapatkan data Vendor berdasarkan ID
                $.get(url, function(data) {
                    // Isi field modal dengan data yang didapat dari server
                    $('#edit_sph_id').val(sphId);
                    $('#edit_nama_project').val(data.nama_project);
                    $('#edit_qty').val(data.qty);
                    $('#edit_satuan').val(data.satuan);
                    $('#edit_harga_satuan').val(data.harga_satuan);


                    // Set URL action form pada modal
                    $('#formEditItem').attr('action', updateUrl);
                });
            });

            $('#formEditItem').on('submit', function(event) {
                event.preventDefault();
                var updateUrl = $(this).attr('action');

                $.ajax({
                    url: updateUrl,
                    type: 'PUT',
                    data: $(this).serialize(),
                    success: function(result) {
                        $('#sph-table').DataTable().ajax.reload();
                        swal({
                            title: 'Berhasil!',
                            text: 'Item berhasil diubah',
                            icon: 'success',
                            button: 'OK'
                        }).then(() => {

                            $('#modalEditItem').modal('hide');

                        });
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) { // Error validasi
                            var errors = xhr.responseJSON.errors;

                            // Kosongkan pesan error lama sebelum menampilkan yang baru
                            $('.error').remove(); // Hapus error sebelumnya

                            // Menampilkan pesan error untuk masing-masing field
                            if (errors.edit_nama_project) {
                                $('#edit_nama_project').after('<div class="text-danger error">' +
                                    errors
                                    .edit_nama_project[0] + '</div>');
                            }
                            if (errors.edit_qty) {
                                $('#edit_qty').after('<div class="text-danger error">' + errors
                                    .edit_qty[
                                        0] + '</div>');
                            }
                            if (errors.edit_satuan) {
                                $('#edit_satuan').after('<div class="text-danger error">' + errors
                                    .edit_satuan[
                                        0] + '</div>');
                            }
                            if (errors.edit_harga_satuan) {
                                $('#edit_harga_satuan').after('<div class="text-danger error">' + errors
                                    .edit_harga_satuan[
                                        0] +
                                    '</div>');
                            }

                        } else {
                            swal({
                                title: 'Gagal!',
                                text: 'Gagal mengedit Item',
                                icon: 'error',
                                button: 'OK'
                            });
                        }
                    }
                });
            });
            $('#btnTambahDetail').on('click', function() {
                let sphId = $(this).attr('data-add-sph-id');
                $('#formAddItem')[0].reset();
                $('#add_sph_id').val(sphId);

            })
            $('#formAddItem').on('submit', function(event) {
                event.preventDefault();
                var createUrl = '/sph-item';

                $.ajax({
                    url: createUrl,
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(result) {
                        $('#sph-table').DataTable().ajax.reload();
                        swal({
                            title: 'Berhasil!',
                            text: 'Item berhasil ditambah',
                            icon: 'success',
                            button: 'OK'
                        });
                        $('#modalAddItem').modal('hide');
                        $('#formAddItem')[0].reset();
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) { // Error validasi
                            var errors = xhr.responseJSON.errors;
                            console.log(errors);
                            // Kosongkan pesan error lama sebelum menampilkan yang baru
                            $('.error').remove(); // Hapus error sebelumnya

                            // Menampilkan pesan error untuk masing-masing field
                            if (errors.add_nama_project) {
                                $('#add_nama_project').after('<div class="text-danger error">' +
                                    errors
                                    .add_nama_project[0] + '</div>');
                            }
                            if (errors.add_qty) {
                                $('#add_qty').after('<div class="text-danger error">' + errors
                                    .add_qty[
                                        0] + '</div>');
                            }
                            if (errors.add_satuan) {
                                $('#add_satuan').after('<div class="text-danger error">' + errors
                                    .add_satuan[
                                        0] + '</div>');
                            }
                            if (errors.add_harga_satuan) {
                                $('#add_harga_satuan').after('<div class="text-danger error">' + errors
                                    .add_harga_satuan[
                                        0] +
                                    '</div>');
                            }
                        } else {
                            swal({
                                title: 'Gagal!',
                                text: 'Gagal menambah Item',
                                icon: 'error',
                                button: 'OK'
                            });
                        }
                    }
                });
            });

            function updateTotalHarga() {
                let total = 0;
                let diskon =

                    // Loop melalui semua baris tabel dan tambahkan nilai kolom jumlah_harga
                    $('#detailEditTable tbody tr').each(function() {
                        let jumlahHarga = parseFloat($(this).find('td:nth-child(6)').text()); // Ambil kolom jumlah_harga
                        if (!isNaN(jumlahHarga)) {
                            total += jumlahHarga;
                        }
                    });

                // Perbarui elemen total harga
                $('#totalHarga').text(total.toLocaleString('id-ID'));
            }


            function reloadDataTable() {
                // Ambil nilai radio button Year yang dipilih
                let year = $('input[name="year"]:checked').val();
                let url = "{{ route('data-sph') }}";

                window.LaravelDataTables['sph-table'].ajax.url(
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

                // Hapus pilihan pada elemen input/filter
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
                    text: 'Data Sph (Surat Penawaran Harga) akan diunduh sebagai file Excel.',
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
                        window.location.href = '{{ route('data-sph.export') }}';
                    } else {
                        // Tampilkan pesan jika batal
                        swal('Batal!', 'Proses unduhan dibatalkan.', 'info');
                    }
                });
            }
        </script>
    @endpush
@endsection
