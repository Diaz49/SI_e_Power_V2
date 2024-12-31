@extends('templates.app')
@section('content')
    <h4 class="text-primary fw-bolder fs-2 m-4">Data Invoice</h4>
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
                    {!! $dataTable->table(['class' => 'display table table-hover table-responsive text-center']) !!}

                </div>
            </div>
        </div>
    </div>

    {{-- Form Tambah --}}
    <div id="form-section" style="display:none;" class="m-4 ">
        <div class=" d-md-flex justify-content-start">
            <p type="button" class="fw-bold" id="btn-cancel"><i class="fas fa-arrow-left"></i> Back</p>
        </div>
        <div class="row">
            <form class="col-md-6" id="formTambahDetail">
                @csrf
                <div class="card p-4">
                    <h5 class="card-title"><span class="badge rounded-circle bg-primary text-white ">
                            1
                        </span> Detail</h5>

                    <div class="mb-1 mt-4 label">Deskripsi</div>
                    <input type="text" class="form-control" name="nama_barang" id="nama_barang" value=""
                        placeholder="Masukkan Nama Barang">


                    <div class="mb-1 mt-2 label">Qty</div>
                    <input type="text" class="form-control" name="qty" id="qty" value=""
                        placeholder="Masukkan Qty">


                    <div class="mb-1 mt-2 label">Satuan</div>
                    <input type="text" class="form-control" name="satuan" id="satuan" value=""
                        placeholder="Masukkan Satuan">


                    <div class="mb-1 mt-2 label">Harga Satuan</div>
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
                    <div class="mb-1 mt-4 label">Kode Invoice</div>
                    <input type="text" class="form-control" name="kode_invoice" id="kode_invoice" value=""
                        placeholder="Masukkan Kode Invoice">

                    <div class="mb-1 mt-2 label">Header Deskripsi</div>
                    <input type="text" class="form-control" name="header_deskripsi" id="header_deskripsi" value=""
                        placeholder="Masukkan Deskripsi">

                    <div class="mb-1 mt-2 label">Tanggal</div>
                    <input type="date" class="form-control" name="tanggal" id="tanggal" value=""
                        placeholder="Pilih Tanggal">


                    <div class="mb-1 mt-2 label">Nama Client</div>
                    <select type="text" class="form-control js-example-basic-single" name="nama_client" id="nama_client"
                        value="" placeholder="Masukkan Nama Client">
                        <option value="">Pilih Client</option>
                        @foreach ($client as $item)
                            <option value="{{ $item->id }}" data-alamat-client="{{ $item->alamat }}"
                                data-nama-client="{{ $item->up_invoice }}">
                                {{ $item->nama_client }}
                            </option>
                        @endforeach
                    </select>

                    <input type="text" class="form-control" name="alamat_client" disabled id="alamat_client"
                        value="" placeholder="Alamat Client">
                    <input type="text" class="form-control" name="kepada" disabled id="kepada" value=""
                        placeholder="Kepada">


                    <div class="mb-1 mt-2 label">No. BAST</div>
                    <input type="text" class="form-control mt-1" name="no_bast_1" id="no_bast_1" value=""
                        placeholder="Nomor Bast 1">
                    <input type="text" class="form-control mt-1" name="no_bast_2" id="no_bast_2" value=""
                        placeholder="Nomor Bast 2">
                    <input type="text" class="form-control mt-1" name="no_bast_3" id="no_bast_3" value=""
                        placeholder="Nomor Bast 3">
                    <input type="text" class="form-control mt-1" name="no_bast_4" id="no_bast_4" value=""
                        placeholder="Nomor Bast 4">
                    <input type="text" class="form-control mt-1" name="no_bast_5" id="no_bast_5" value=""
                        placeholder="Nomor Bast 5">


                    <div class="mb-1 mt-2 label">Jenis No.</div>
                    <select type="text" class="form-control js-example-basic-single" name="jenis_no" id="jenis_no"
                        value="" placeholder="Masukkan Nama Client">
                        <option value="">Pilih Jenis No.</option>

                        <option value="PO">PO</option>
                        <option value="Kontrak">Kontrak</option>
                        <option value="SPK">SPK</option>
                        <option value="SPPK">SPPK</option>
                        <option value="FPB">FPB</option>
                    </select>
                    <input type="text" class="form-control" name="no_1" id="no_1" value=""
                        placeholder="Nomor 1">
                    <input type="text" class="form-control mt-1" name="no_2" id="no_2" value=""
                        placeholder="Nomor 2">
                    <input type="text" class="form-control mt-1" name="no_3" id="no_3" value=""
                        placeholder="Nomor 3">
                    <input type="text" class="form-control mt-1" name="no_4" id="no_4" value=""
                        placeholder="Nomor 4">
                    <input type="text" class="form-control mt-1" name="no_5" id="no_5" value=""
                        placeholder="Nomor 5">


                    <div class="mb-1 mt-2 label">Due Date</div>
                    <input type="date" class="form-control" name="due_date" id="due_date" value=""
                        placeholder="Pilih Tanggal">

                    <div class="mb-1 mt-2 label">Nama Bank</div>
                    <select type="text" class="form-control js-example-basic-single" name="nama_bank" id="nama_bank"
                        value="" placeholder="Masukkan Nama Bank">
                        <option value="">Pilih Bank</option>
                        @foreach ($bank as $item)
                            <option value="{{ $item->id }}" data-nama-rek="{{ $item->nama_rek }}"
                                data-no-rek="{{ $item->nomer_rek }}">{{ $item->nama_bank }}
                            </option>
                        @endforeach
                    </select>
                    <input type="text" class="form-control" name="nama_rek" disabled id="nama_rek" value=""
                        placeholder="A/N">
                    <input type="text" class="form-control" disabled name="no_rek" id="no_rek" value=""
                        placeholder="A/C">
                </div>



                <div class="d-flex justify-content-end mt-3">
                    <button type="submit" id="btn_header" class="btn btn-primary"><i class="far fa-save"></i>
                        Save</button>
                </div>
            </form>

        </div>

        {{-- Table --}}
        <div class="mt-4 table-responsive">
            <table class="table table-bordered " id="detailTable">
                <thead class="table-dark text-center">
                    <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
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
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalEditDetailLabel">Edit Data Header</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body ps-4 me-2">
                        <div class="row">

                            <div class="col-md-6 ">
                                <div class="mb-1 mt-2 label">Kode Invoice</div>
                                <input type="text" class="form-control" name="edit_kode_invoice"
                                    id="edit_kode_invoice" value="" placeholder="Masukkan Kode Invoice">

                                <div class="mb-1 mt-2 label">Header Deskripsi</div>
                                <input type="text" class="form-control" name="edit_header_deskripsi"
                                    id="edit_header_deskripsi" value="" placeholder="Masukkan Deskripsi">

                                <div class="mb-1 mt-2 label">Tanggal</div>
                                <input type="date" class="form-control" name="edit_tanggal" id="edit_tanggal"
                                    value="" placeholder="Pilih Tanggal">


                                <div class="mb-1 mt-2 label">Nama Client</div>
                                <select type="text" class="form-control js-example-basic-single"
                                    name="edit_nama_client" id="edit_nama_client" value=""
                                    placeholder="Masukkan Nama Client">
                                    <option value="">Pilih Client</option>
                                    @foreach ($client as $item)
                                        <option value="{{ $item->id }}" data-alamat-client="{{ $item->alamat }}"
                                            data-nama-client="{{ $item->up_invoice }}">
                                            {{ $item->nama_client }}
                                        </option>
                                    @endforeach
                                </select>

                                <input type="text" class="form-control" name="edit_alamat_client" disabled
                                    id="edit_alamat_client" value="" placeholder="Alamat Client">
                                <input type="text" class="form-control" name="edit_kepada" disabled id="edit_kepada"
                                    value="" placeholder="Kepada">


                                <div class="mb-1 mt-2 label">No. BAST</div>
                                <input type="text" class="form-control mt-1" name="edit_no_bast_1"
                                    id="edit_no_bast_1" value="" placeholder="Nomor Bast 1">
                                <input type="text" class="form-control mt-1" name="edit_no_bast_2"
                                    id="edit_no_bast_2" value="" placeholder="Nomor Bast 2">
                                <input type="text" class="form-control mt-1" name="edit_no_bast_3"
                                    id="edit_no_bast_3" value="" placeholder="Nomor Bast 3">
                                <input type="text" class="form-control mt-1" name="edit_no_bast_4"
                                    id="edit_no_bast_4" value="" placeholder="Nomor Bast 4">
                                <input type="text" class="form-control mt-1" name="edit_no_bast_5"
                                    id="edit_no_bast_5" value="" placeholder="Nomor Bast 5">

                                <div class="mb-1 mt-2 label">Kode Admin</div>
                                <input type="text" class="form-control" name="edit_kode_admin" id="edit_kode_admin"
                                    value="" placeholder="Masukkan Kode Admin">
                            </div>
                            <div class="col-md-6">
                                <div class="mb-1 mt-2 label">Jenis No.</div>
                                <select type="text" class="form-control js-example-basic-single" name="edit_jenis_no"
                                    id="edit_jenis_no" value="" placeholder="Masukkan Nama Client">
                                    <option value="">Pilih Jenis No.</option>

                                    <option value="PO">PO</option>
                                    <option value="Kontrak">Kontrak</option>
                                    <option value="SPK">SPK</option>
                                    <option value="SPPK">SPPK</option>
                                    <option value="FPB">FPB</option>
                                </select>
                                </select>
                                <input type="text" class="form-control" name="edit_no_1" id="edit_no_1"
                                    value="" placeholder="Nomor 1">
                                <input type="text" class="form-control mt-1" name="edit_no_2" id="edit_no_2"
                                    value="" placeholder="Nomor 2">
                                <input type="text" class="form-control mt-1" name="edit_no_3" id="edit_no_3"
                                    value="" placeholder="Nomor 3">
                                <input type="text" class="form-control mt-1" name="edit_no_4" id="edit_no_4"
                                    value="" placeholder="Nomor 4">
                                <input type="text" class="form-control mt-1" name="edit_no_5" id="edit_no_5"
                                    value="" placeholder="Nomor 5">


                                <div class="mb-1 mt-2 label">Due Date</div>
                                <input type="date" class="form-control" name="edit_due_date" id="edit_due_date"
                                    value="" placeholder="Pilih Tanggal">

                                <div class="mb-1 mt-2 label">Nama Bank</div>
                                <select type="text" class="form-control js-example-basic-single" name="edit_nama_bank"
                                    id="edit_nama_bank" value="" placeholder="Masukkan Nama Bank">
                                    <option value="">Pilih Bank</option>
                                    @foreach ($bank as $item)
                                        <option value="{{ $item->id }}" data-nama-rek="{{ $item->nama_rek }}"
                                            data-no-rek="{{ $item->nomer_rek }}">{{ $item->nama_bank }}
                                        </option>
                                    @endforeach
                                </select>
                                <input type="text" class="form-control" name="edit_nama_rek" disabled
                                    id="edit_nama_rek" value="" placeholder="A/N">
                                <input type="text" class="form-control" disabled name="edit_no_rek" id="edit_no_rek"
                                    value="" placeholder="A/C">
                                <div class="mb-1 mt-2 label">No. fp</div>
                                <input type="text" class="form-control" name="edit_no_fp" id="edit_no_fp"
                                    value="" placeholder="Masukkan No. fp">
                                <div class="mb-1 mt-2 label">Status</div>
                                <select type="text" class="form-control js-example-basic-single" name="edit_status"
                                    id="edit_status" value="" placeholder="Masukkan Nama Client">
                                    <option value="">Pilih Jenis Status</option>

                                    <option value="-">-</option>
                                    <option value="paid">PAID</option>

                                </select>
                                <div class="mb-1 mt-2 label">Tanggal Paid</div>
                                <input type="date" class="form-control" name="edit_paid" id="edit_paid" disabled
                                    value="" placeholder="Pilih Tanggal">
                            </div>
                        </div>
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
            let detailArray = [];
            let no = 1;

            $(document).on('click', '#btnDeleteInvoice', function() {
                var url = $(this).data('url');
                var tableId = $(this).data('table-id');
                var name = $(this).data('name');

                // Tampilkan SweetAlert konfirmasi
                swal({
                    text: 'Apa kamu yakin ingin menghapus Invoice ' + name + '?',
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
                                    text: 'Invoice ' + name + ' berhasil dihapus',
                                    icon: 'success',
                                    button: 'OK'
                                });
                            },
                            error: function(xhr) {
                                // Menampilkan SweetAlert error jika gagal
                                swal({
                                    title: 'Gagal!',
                                    text: 'Gagal menghapus PO',
                                    icon: 'error',
                                    button: 'OK'
                                });
                            }
                        });
                    }
                });
            });

            $(document).on('click', 'a[data-bs-target="#modalEditHeader"]', function() {

                $('.error').remove(); // Hapus error sebelumnya
                var invoiceId = $(this).data('id'); // Ambil ID dari tombol edit
                var url = '/invoice/' + invoiceId + '/edit'; // URL untuk ambil data
                var updateUrl = '/invoice/' + invoiceId; // URL untuk update data

                // Request AJAX untuk mendapatkan data Vendor berdasarkan ID
                $.get(url, function(data) {
                    // Isi field modal dengan data yang didapat dari server
                    $('#edit_kode_invoice').val(data.kd_invoice);
                    $('#edit_header_deskripsi').val(data.header_deskripsi);
                    $('#edit_tanggal').val(data.tgl_invoice);
                    $('#edit_nama_client').val(data.client_id).trigger('change');
                    $('#edit_no_bast_1').val(data.no_bast_1);
                    $('#edit_no_bast_2').val(data.no_bast_2);
                    $('#edit_no_bast_3').val(data.no_bast_3);
                    $('#edit_no_bast_4').val(data.no_bast_4);
                    $('#edit_no_bast_5').val(data.no_bast_5);
                    $('#edit_jenis_no').val(data.jenis_no);
                    $('#edit_due_date').val(data.due);
                    $('#edit_nama_bank').val(data.bank_id).trigger('change');
                    $('#edit_no_1').val(data.no_1);
                    $('#edit_no_2').val(data.no_2);
                    $('#edit_no_3').val(data.no_3);
                    $('#edit_no_4').val(data.no_4);
                    $('#edit_kode_admin').val(data.kd_admin);
                    $('#edit_no_fp').val(data.no_fp);
                    $('#edit_status').val(data.status).trigger('change');
                    $('#edit_paid').val(data.tgl_paid);
                    // Set URL acti.val(data.bank_id);on form pada modal
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
                    url: '/invoice', // URL endpoint untuk menyimpan data
                    type: 'POST',
                    data: JSON.stringify(dataToSend),
                    contentType: 'application/json', // Pastikan data dikirim dalam format JSON
                    success: function(response) {
                        swal({
                            title: 'Berhasil!',
                            text: 'Data Invoice berhasil disimpan!',
                            icon: 'success',
                            button: 'OK',
                        });
                        // Reset form dan tabel detail
                        $('#formTambahHeader')[0].reset();
                        $('#detailTable tbody').html('');
                        $('#invoice-table').DataTable().ajax.reload();
                        $('.error').remove();
                        detailArray = [];
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) { // Error validasi
                            var errors = xhr.responseJSON.errors;

                            // Hapus pesan error sebelumnya
                            $('.error').remove();

                            // Menampilkan pesan error baru
                            if (errors['header.kode_invoice']) {
                                $('#kode_invoice').after('<div class="text-danger error">' + errors[
                                    'header.kode_invoice'][0] + '</div>');
                            }
                            if (errors['header.header_deskripsi']) {
                                $('#header_deskripsi').after('<div class="text-danger error">' + errors[
                                    'header.header_deskripsi'][0] + '</div>');
                            }
                            if (errors['header.tanggal']) {
                                $('#tanggal').after('<div class="text-danger error">' + errors[
                                    'header.tanggal'][0] + '</div>');
                            }
                            if (errors['header.nama_client']) {
                                $('#nama_client').after('<div class="text-danger error">' + errors[
                                    'header.nama_client'][0] + '</div>');
                            }
                            if (errors['header.no_bast_1']) {
                                $('#no_bast_1').after('<div class="text-danger error">' + errors[
                                    'header.no_bast_1'][0] + '</div>');
                            }
                            if (errors['header.no_bast_2']) {
                                $('#no_bast_2').after('<div class="text-danger error">' + errors[
                                    'header.no_bast_2'][0] + '</div>');
                            }
                            if (errors['header.no_bast_3']) {
                                $('#no_bast_3').after('<div class="text-danger error">' + errors[
                                    'header.no_bast_3'][0] + '</div>');
                            }
                            if (errors['header.no_bast_4']) {
                                $('#no_bast_4').after('<div class="text-danger error">' + errors[
                                    'header.no_bast_4'][0] + '</div>');
                            }
                            if (errors['header.no_bast_5']) {
                                $('#no_bast_5').after('<div class="text-danger error">' + errors[
                                    'header.no_bast_5'][0] + '</div>');
                            }
                            if (errors['header.jenis_no']) {
                                $('#jenis_no').after('<div class="text-danger error">' + errors[
                                    'header.jenis_no'][0] + '</div>');
                            }
                            if (errors['header.due_date']) {
                                $('#due_date').after('<div class="text-danger error">' + errors[
                                    'header.due_date'][0] + '</div>');
                            }
                            if (errors['header.nama_bank']) {
                                $('#nama_bank').after('<div class="text-danger error">' + errors[
                                    'header.nama_bank'][0] + '</div>');
                            }
                            if (errors['header.no_1']) {
                                $('#no_1').after('<div class="text-danger error">' + errors[
                                    'header.no_1'][0] + '</div>');
                            }
                            if (errors['header.no_2']) {
                                $('#no_2').after('<div class="text-danger error">' + errors[
                                    'header.no_2'][0] + '</div>');
                            }
                            if (errors['header.no_3']) {
                                $('#no_3').after('<div class="text-danger error">' + errors[
                                    'header.no_3'][0] + '</div>');
                            }
                            if (errors['header.no_4']) {
                                $('#no_4').after('<div class="text-danger error">' + errors[
                                    'header.no_4'][0] + '</div>');
                            }
                            if (errors['header.no_5']) {
                                $('#no_5').after('<div class="text-danger error">' + errors[
                                    'header.no_5'][0] + '</div>');
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
                const nama_barang = $('#nama_barang').val();
                const qty = $('#qty').val();
                const satuan = $('#satuan').val();
                const harga_satuan = $('#harga_satuan').val();
                const jumlah_harga = qty * harga_satuan;

                // Hapus pesan error sebelumnya
                $('.error').remove();

                // Validasi Nama Barang
                if (!nama_barang || nama_barang.length === 0 || nama_barang.length > 100) {
                    $('#nama_barang').after(
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
                    nama_barang,
                    qty,
                    satuan,
                    harga_satuan,
                    jumlah_harga
                });

                // Render data ke tabel
                var rowDetail = `
            <tr>
                <td>${no++}</td>
                <td>${nama_barang}</td>
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
                $('#nama_vendor').val(null).trigger('change');

                // $('#formTambah')[0].reset();
            })

            $(document).ready(function() {
                $('#nama_client').select2();
                $('#jenis_no').select2();
                $('#nama_bank').select2();

                $('#edit_status').select2({
                    dropdownParent: $('#modalEditHeader'),
                    width: '100%'
                });
                $('#edit_nama_client').select2({
                    dropdownParent: $('#modalEditHeader'),
                    width: '100%'
                });
                $('#edit_jenis_no').select2({
                    dropdownParent: $('#modalEditHeader'),
                    width: '100%'
                });
                $('#edit_nama_bank').select2({
                    dropdownParent: $('#modalEditHeader'),
                    width: '100%'
                });
                // Menangkap event change pada select2
                $('#nama_client').on('change', function() {
                    // Ambil ID vendor yang dipilih
                    var clientId = $(this).val();

                    // Cari data vendor berdasarkan ID (misalnya, dalam elemen data-* yang sudah ada di halaman)
                    var client = $('#nama_client option').filter(function() {
                        return $(this).val() == clientId;
                    }).data();

                    // Isi input dengan data yang sesuai
                    if (clientId) {
                        $('#alamat_client').val(client.alamatClient);
                        $('#kepada').val(client.namaClient);

                    } else {
                        // Kosongkan input jika tidak ada vendor yang dipilih
                        $('#alamat_client, #kepada').val('');
                    }
                });
                $('#nama_bank').on('change', function() {
                    // Ambil ID vendor yang dipilih
                    var bankId = $(this).val();

                    // Cari data vendor berdasarkan ID (misalnya, dalam elemen data-* yang sudah ada di halaman)
                    var bank = $('#nama_bank option').filter(function() {
                        return $(this).val() == bankId;
                    }).data();
                    // Isi input dengan data yang sesuai
                    if (bankId) {
                        $('#nama_rek').val(bank.namaRek);
                        $('#no_rek').val(bank.noRek);

                    } else {
                        // Kosongkan input jika tidak ada vendor yang dipilih
                        $('#nama_rek, #no_rek').val('');
                    }
                });
                $('#edit_nama_client').on('change', function() {
                    // Ambil ID vendor yang dipilih
                    var clientId = $(this).val();

                    // Cari data vendor berdasarkan ID (misalnya, dalam elemen data-* yang sudah ada di halaman)
                    var client = $('#edit_nama_client option').filter(function() {
                        return $(this).val() == clientId;
                    }).data();

                    // Isi input dengan data yang sesuai
                    if (clientId) {
                        $('#edit_alamat_client').val(client.alamatClient);
                        $('#edit_kepada').val(client.namaClient);

                    } else {
                        // Kosongkan input jika tidak ada vendor yang dipilih
                        $('#edit_alamat_client, #edit_kepada').val('');
                    }
                });
                $('#edit_nama_bank').on('change', function() {
                    // Ambil ID vendor yang dipilih
                    var bankId = $(this).val();

                    // Cari data vendor berdasarkan ID (misalnya, dalam elemen data-* yang sudah ada di halaman)
                    var bank = $('#edit_nama_bank option').filter(function() {
                        return $(this).val() == bankId;
                    }).data();
                    // Isi input dengan data yang sesuai
                    if (bankId) {
                        $('#edit_nama_rek').val(bank.namaRek);
                        $('#edit_no_rek').val(bank.noRek);

                    } else {
                        // Kosongkan input jika tidak ada vendor yang dipilih
                        $('#edit_nama_rek, #edit_no_rek').val('');
                    }
                });

                $('#edit_status').on('change', function() {
                    var paid = $('#edit_status').val();

                    if (paid === 'paid') {
                        $('#edit_paid').prop('disabled', false);
                    } else {
                        $('#edit_paid').prop('disabled', true)
                    }
                })

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
                        $('#invoice-table').DataTable().ajax.reload();
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
                            if (errors.edit_kode_invoice) {
                                $('#edit_kode_invoice').after('<div class="text-danger error">' +
                                    errors
                                    .edit_kode_invoice[0] + '</div>');
                            }
                            if (errors.edit_header_deskripsi) {
                                $('#edit_header_deskripsi').after('<div class="text-danger error">' + errors
                                    .edit_header_deskripsi[
                                        0] + '</div>');
                            }
                            if (errors.edit_tanggal) {
                                $('#edit_tanggal').after('<div class="text-danger error">' + errors
                                    .edit_tanggal[
                                        0] + '</div>');
                            }
                            if (errors.edit_nama_client) {
                                $('#edit_nama_client').after('<div class="text-danger error">' + errors
                                    .edit_nama_client[
                                        0] +
                                    '</div>');
                            }
                            if (errors.edit_no_bast_1) {
                                $('#edit_no_bast_1').after('<div class="text-danger error">' + errors
                                    .edit_no_bast_1[
                                        0] +
                                    '</div>');
                            }
                            if (errors.edit_no_bast_2) {
                                $('#edit_no_bast_2').after('<div class="text-danger error">' + errors
                                    .edit_no_bast_2[
                                        0] +
                                    '</div>');
                            }
                            if (errors.edit_no_bast_3) {
                                $('#edit_no_bast_3').after('<div class="text-danger error">' + errors
                                    .edit_no_bast_3[
                                        0] +
                                    '</div>');
                            }
                            if (errors.edit_no_bast_4) {
                                $('#edit_no_bast_4').after('<div class="text-danger error">' + errors
                                    .edit_no_bast_4[
                                        0] +
                                    '</div>');
                            }   if (errors.edit_no_bast_5) {
                                $('#edit_no_bast_5').after('<div class="text-danger error">' + errors
                                    .edit_no_bast_5[
                                        0] +
                                    '</div>');
                            }   if (errors.edit_jenis_no) {
                                $('#edit_jenis_no').after('<div class="text-danger error">' + errors
                                    .edit_jenis_no[
                                        0] +
                                    '</div>');
                            }   if (errors.edit_no_1) {
                                $('#edit_no_1').after('<div class="text-danger error">' + errors
                                    .edit_no_1[
                                        0] +
                                    '</div>');
                            }   if (errors.edit_no_2) {
                                $('#edit_no_2').after('<div class="text-danger error">' + errors
                                    .edit_no_2[
                                        0] +
                                    '</div>');
                            }   if (errors.edit_no_3) {
                                $('#edit_no_3').after('<div class="text-danger error">' + errors
                                    .edit_no_3[
                                        0] +
                                    '</div>');
                            }   if (errors.edit_no_4) {
                                $('#edit_no_4').after('<div class="text-danger error">' + errors
                                    .edit_no_4[
                                        0] +
                                    '</div>');
                            }   if (errors.edit_no_5) {
                                $('#edit_no_5').after('<div class="text-danger error">' + errors
                                    .edit_no_5[
                                        0] +
                                    '</div>');
                            }   if (errors.edit_due_date) {
                                $('#edit_due_date').after('<div class="text-danger error">' + errors
                                    .edit_due_date[
                                        0] +
                                    '</div>');
                            }   if (errors.edit_nama_bank) {
                                $('#edit_nama_bank').after('<div class="text-danger error">' + errors
                                    .edit_nama_bank[
                                        0] +
                                    '</div>');
                            }   if (errors.edit_paid) {
                                $('#edit_paid').after('<div class="text-danger error">' + errors
                                    .edit_paid[
                                        0] +
                                    '</div>');
                            }   if (errors.edit_status) {
                                $('#edit_status').after('<div class="text-danger error">' + errors
                                    .edit_status[
                                        0] +
                                    '</div>');
                            }   if (errors.edit_no_fp) {
                                $('#edit_no_fp').after('<div class="text-danger error">' + errors
                                    .edit_no_fp[
                                        0] +
                                    '</div>');
                            }   if (errors.edit_kode_admin) {
                                $('#edit_kode_admin').after('<div class="text-danger error">' + errors
                                    .edit_kode_admin[
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
                let poId = $(this).data('id'); // Ambil ID PO dari tombol
                $('#btnTambahDetail').attr('data-add-po-id', poId);


                // AJAX request untuk mengambil data detail
                $.ajax({
                    url: `/po-detail/${poId}/edit`, // Endpoint untuk method edit
                    type: 'GET',
                    success: function(response) {
                        // Kosongkan tabel sebelum menambahkan data baru
                        $('#detailEditTable tbody').empty();

                        // Loop data detail dan tambahkan ke tabel
                        response.detail.forEach((detail, index) => {
                            $('#detailEditTable tbody').append(`
                <tr id="row-${detail.id}">
                    <td>${index + 1}</td>
                    <td>${detail.nama_barang}</td>
                    <td>${detail.qty}</td>
                    <td>${detail.satuan}</td>
                    <td>${detail.harga_satuan}</td>
                    <td>${detail.jumlah_harga}</td>
                <td>
                    <div class="dropdown">
                    <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false"
                        style="--bs-btn-active-border-color:transparent;">
                        <i class="fas fa-ellipsis-h"></i>
                    </button>
                    <ul class="dropdown-menu">
                    
                        <li><a href="javascript:void(0)" id="btnEditItem"  class="dropdown-item text-info fw-bold d-flex justify-content-between py-2"
                                data-id="${detail.id}" data-po-id="${poId}" type="button" data-bs-toggle="modal" data-bs-target="#modalEditItem">Edit Detail<i
                                    class="ml-4 fas fa-pen"></i></a></li>
                        <li>
                            <button class="dropdown-item text-danger fw-bold d-flex justify-content-between py-2" id="btnDeleteDetailItem" type="button"
                                data-table-id="invoice-table" data-url="po-detail/delete/${detail.id}" data-id="${detail.id}"
                                data-name="${detail.nama_barang}" data-action="delete">
                                Delete <i class="fas fa-trash"></i>
                            </button>

                        </li>
                    </ul>
                      </div>

                </td>
                </tr>
            `);
                            updateTotalHarga();
                        });

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

                                    $('#invoice-table').DataTable().ajax
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
                var poId = $(this).data('po-id'); // Ambil ID dari tombol edit
                var url = '/po-item/' + itemId + '/edit'; // URL untuk ambil data
                var updateUrl = '/po-item/' + itemId; // URL untuk update data

                // Request AJAX untuk mendapatkan data Vendor berdasarkan ID
                $.get(url, function(data) {
                    // Isi field modal dengan data yang didapat dari server
                    $('#edit_po_id').val(poId);
                    $('#edit_nama_barang').val(data.nama_barang);
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
                        $('#invoice-table').DataTable().ajax.reload();
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
                            if (errors.edit_nama_barang) {
                                $('#edit_nama_barang').after('<div class="text-danger error">' +
                                    errors
                                    .edit_nama_barang[0] + '</div>');
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
                let poId = $(this).attr('data-add-po-id');
                $('#formAddItem')[0].reset();
                $('#add_po_id').val(poId);

            })
            $('#formAddItem').on('submit', function(event) {
                event.preventDefault();
                var createUrl = '/po-item';

                $.ajax({
                    url: createUrl,
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(result) {
                        $('#invoice-table').DataTable().ajax.reload();
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
                            if (errors.add_nama_barang) {
                                $('#add_nama_barang').after('<div class="text-danger error">' +
                                    errors
                                    .add_nama_barang[0] + '</div>');
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
        </script>
    @endpush
@endsection
