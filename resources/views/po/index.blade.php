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
                    <input type="text" class="form-control" name="po_id" id="po_id" hidden>

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
                    <div class="mb-1 mt-4 label">Kode Purchase Order</div>
                    <input type="text" class="form-control" name="kode_purchase_order" id="kode_purchase_order"
                        value="" placeholder="Masukkan Kode Purchase Order">


                    <div class="mb-1 mt-2 label">Tanggal</div>
                    <input type="date" class="form-control" name="tanggal" id="tanggal" value=""
                        placeholder="Pilih Tanggal">


                    <div class="mb-1 mt-2 label">Nama Vendor</div>
                    <select type="text" class="form-control js-example-basic-single" name="nama_vendor" id="nama_vendor"
                        value="" placeholder="Masukkan Nama Vendor">
                        <option value="">Pilih Vendor</option>
                        @foreach ($vendor as $item)
                            <option value="{{ $item->id }}" data-alamat="{{ $item->alamat_vendor }}"
                                data-kota="{{ $item->kota }}" data-up="{{ $item->up }}"
                                data-email="{{ $item->email }}" data-nomor="{{ $item->no_tlp }}">{{ $item->nama_vendor }}
                            </option>
                        @endforeach
                    </select>

                    <input type="text" class="form-control" name="alamat_vendor" disabled id="alamat_vendor"
                        value="" placeholder="Alamat Vendor">
                    <input type="text" class="form-control" name="kota_vendor" disabled id="kota_vendor"
                        value="" placeholder="Kota Vendor">
                    <input type="text" class="form-control" name="up_vendor" disabled id="up_vendor" value=""
                        placeholder="Up Venodr">
                    <input type="text" class="form-control" name="email_vendor" disabled id="email_vendor"
                        value="" placeholder="Email Vendor">
                    <input type="text" class="form-control" name="nomor_vendor" disabled id="nomor_vendor"
                        value="" placeholder="Nomor Telepon">


                    <div class="mb-1 mt-2 label">Nama Buyer</div>
                    <input type="text" class="form-control" name="nama_buyer" id="nama_buyer" value=""
                        placeholder="Masukkan Nama Buyer">


                    <div class="mb-1 mt-2 label">Perihal</div>
                    <input type="text" class="form-control" name="perihal" id="perihal" value=""
                        placeholder="Masukkan Perihal">


                    <div class="mb-1 mt-2 label">Catatan</div>
                    <input type="text" class="form-control" name="catatan" id="catatan" value=""
                        placeholder="Masukkan Catatan 1">
                    <input type="text" class="form-control" name="catatan_2" id="catatan_2" value=""
                        placeholder="Masukkan Catatan 2">


                    <div class="mb-1 mt-2 label">Diskon Nominal Rupiah</div>
                    <input type="number" class="form-control" name="diskon_rupiah" id="diskon_rupiah" value=""
                        placeholder="Masukkan Diskon Nominal Rupiah">
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

    </div>


    <!-- Modal Edit -->

    @push('scripts')
        {{ $dataTable->scripts() }}
        <script>
            let detailArray = [];
            let no = 1;

            $(document).on('click', 'button[data-action="delete"]', function() {
                var url = $(this).data('url');
                var tableId = $(this).data('table-id');
                var name = $(this).data('name');

                // Tampilkan SweetAlert konfirmasi
                swal({
                    text: 'Apa kamu yakin ingin menghapus PO ' + name + '?',
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
                                    text: 'PO ' + name + ' berhasil dihapus',
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
                    url: '/po', // URL endpoint untuk menyimpan data
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
                        $('#purchaseorder-table').DataTable().ajax.reload();
                        $('.error').remove();
                        detailArray = [];
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) { // Error validasi
                            var errors = xhr.responseJSON.errors;

                            // Hapus pesan error sebelumnya
                            $('.error').remove();

                            // Menampilkan pesan error baru
                            if (errors['header.kode_purchase_order']) {
                                $('#kode_purchase_order').after('<div class="text-danger error">' + errors[
                                    'header.kode_purchase_order'][0] + '</div>');
                            }
                            if (errors['header.tanggal']) {
                                $('#tanggal').after('<div class="text-danger error">' + errors[
                                    'header.tanggal'][0] + '</div>');
                            }
                            if (errors['header.nama_vendor']) {
                                $('#nama_vendor').after('<div class="text-danger error">' + errors[
                                    'header.nama_vendor'][0] + '</div>');
                            }
                            if (errors['header.nama_buyer']) {
                                $('#nama_buyer').after('<div class="text-danger error">' + errors[
                                    'header.nama_buyer'][0] + '</div>');
                            }
                            if (errors['header.perihal']) {
                                $('#perihal').after('<div class="text-danger error">' + errors[
                                    'header.perihal'][0] + '</div>');
                            }
                            if (errors['header.catatan']) {
                                $('#catatan').after('<div class="text-danger error">' + errors[
                                    'header.catatan'][0] + '</div>');
                            }
                            if (errors['header.catatan_2']) {
                                $('#catatan_2').after('<div class="text-danger error">' + errors[
                                    'header.catatan_2'][0] + '</div>');
                            }
                            if (errors['header.diskon_rupiah']) {
                                $('#diskon_rupiah').after('<div class="text-danger error">' + errors[
                                    'header.diskon_rupiah'][0] + '</div>');
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
                const po_id = $('#po_id').val(); // Misalnya, ID PO sudah ada di form
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
                if (!harga_satuan || isNaN(harga_satuan) || harga_satuan < 0 || harga_satuan > 99999999999999999999.99) {
                    $('#harga_satuan').after(
                        '<div class="text-danger error">Harga satuan harus berupa angka .</div>'
                    );
                    return;
                }

                // Semua validasi lolos, lanjutkan menambah detail
                detailArray.push({
                    no,
                    po_id,
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
            <td colspan="5" class=" fw-bold">Subtotal:</td>
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

            function detailDisable() {
                $('#nama_barang').prop('disabled', true);
                $('#qty').prop('disabled', true);
                $('#satuan').prop('disabled', true);
                $('#harga_satuan').prop('disabled', true);
                $('#btn_detail').prop('disabled', true);
            }

            function detailEnable() {
                $('#nama_barang').prop('disabled', false);
                $('#qty').prop('disabled', false);
                $('#satuan').prop('disabled', false);
                $('#harga_satuan').prop('disabled', false);
                $('#btn_detail').prop('disabled', false);
            }

            function headerDisable() {
                $('#kode_purchase_order').prop('disabled', true);
                $('#tanggal').prop('disabled', true);
                $('#nama_vendor').prop('disabled', true);
                $('#nama_buyer').prop('disabled', true);
                $('#perihal').prop('disabled', true);
                $('#catatan').prop('disabled', true);
                $('#catatan_2').prop('disabled', true);
                $('#diskon_rupiah').prop('disabled', true);
                $('#btn_header').prop('disabled', true);
            }

            function headerEnable() {
                $('#kode_purchase_order').prop('disabled', false);
                $('#tanggal').prop('disabled', false);
                $('#nama_vendor').prop('disabled', false);
                $('#nama_buyer').prop('disabled', false);
                $('#perihal').prop('disabled', false);
                $('#catatan').prop('disabled', false);
                $('#catatan_2').prop('disabled', false);
                $('#diskon_rupiah').prop('disabled', false);
                $('#btn_header').prop('disabled', false);
            }
            $(document).ready(function() {
                $('.js-example-basic-single').select2();
                // Menangkap event change pada select2
                $('#nama_vendor').on('change', function() {
                    // Ambil ID vendor yang dipilih
                    var vendorId = $(this).val();

                    // Cari data vendor berdasarkan ID (misalnya, dalam elemen data-* yang sudah ada di halaman)
                    var vendor = $('#nama_vendor option').filter(function() {
                        return $(this).val() == vendorId;
                    }).data();

                    // Isi input dengan data yang sesuai
                    if (vendorId) {
                        $('#alamat_vendor').val(vendor.alamat);
                        $('#kota_vendor').val(vendor.kota);
                        $('#up_vendor').val(vendor.up);
                        $('#email_vendor').val(vendor.email);
                        $('#nomor_vendor').val(vendor.nomor);
                    } else {
                        // Kosongkan input jika tidak ada vendor yang dipilih
                        $('#alamat_vendor, #kota_vendor, #up_vendor, #email_vendor, #nomor_vendor').val('');
                    }
                });

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
        </script>
    @endpush
@endsection
