<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class=" my-5">
        <div class="row mb-4">
            <div class="col-6">
                <img src="{{ asset('img/logo.png') }}" alt="Company Logo" class="img-fluid" style="max-width: 150px;">
                <p> Jl. Gunung Anyar Tambak IV No. 50<br>
                    Kelurahan Gunung Anyar Kec. Gunung Anyar Kota Surabaya Jawa Timur 60249<br>
                    Email: multipowerabadi@gmail.com<br>
                    Telp: 031-59178774 & Hp: 0811272825<br>
                    NPWP: 71.425.962.9-606.000<br></p>
            </div>
            <div class="col-6 text-end">
                <p><a href="#"
                        class="fs-2 fw-bolder text-dark link-underline-dark link-underlinelink-offset-2 link-underline-opacity-100 ">INVOICE</a>
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col-6">
                <table>
                    <tbody>
                        <tr>
                            <td>
                                <span>

                                    <strong>Kepada</strong>
                                </span>

                            </td>
                            <td>

                                <span>: {{ $invoice->client->nama_client }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>

                                    <strong>Alamat Kantor</strong>
                                </span>
                            </td>
                            <td>
                                <span>: {{ $invoice->client->alamat_client }}</span>
                            </td>
                        </tr>
                    </tbody>
                </table>

            </div>
            <div class="col-6">
                <table>
                    <tbody>
                        <tr>
                            <td>
                                <span>-</span>
                                    <strong>
                                        No. Invoice
                                    </strong>
                                </span>
                            </td>
                            <td>
                                <span>: MPA0559/Dir.01/INV/XII/2024</span>

                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>
                                    <strong>Tgl. Invoice</strong>
                                </span>
                            </td>
                            <td>
                                <span>: 31 Desember 2024</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span><strong>Due Date Inv.</strong>
                                </span>

                            </td>
                            <td>
                                <span>: 31 Januari 2025</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-4">
            <table class="table table-bordered">
                <thead>
                    <tr class="table-primary">
                        <th scope="col">No</th>
                        <th scope="col">Deskripsi</th>
                        <th scope="col">Qty</th>
                        <th scope="col">Satuan</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Mihrab Musholla + List Ornamen Musholla</td>
                        <td>1.00</td>
                        <td>UNIT</td>
                        <td>Rp. 8,500,000</td>
                        <td>Rp. 8,500,000</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Kabinet Janitor Uk. 80x120x30</td>
                        <td>1.00</td>
                        <td>UNIT</td>
                        <td>Rp. 4,450,000</td>
                        <td>Rp. 4,450,000</td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>Pek. Pintu Wet Pantry</td>
                        <td>1.00</td>
                        <td>UNIT</td>
                        <td>Rp. 5,500,000</td>
                        <td>Rp. 5,500,000</td>
                    </tr>
                    <tr>
                        <th scope="row">4</th>
                        <td>Pek. Sliding Musholla</td>
                        <td>1.00</td>
                        <td>UNIT</td>
                        <td>Rp. 5,500,000</td>
                        <td>Rp. 5,500,000</td>
                    </tr>
                    <tr>
                        <th scope="row">5</th>
                        <td>Pek. Pintu Janitor</td>
                        <td>1.00</td>
                        <td>UNIT</td>
                        <td>Rp. 5,500,000</td>
                        <td>Rp. 5,500,000</td>
                    </tr>
                    <tr>
                        <th scope="row">6</th>
                        <td>Pengadaan kunci meja loker</td>
                        <td>7.00</td>
                        <td>UNIT</td>
                        <td>Rp. 180,000</td>
                        <td>Rp. 1,260,000</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5" class="text-end fw-bold">JUMLAH</td>
                        <td>Rp. 30,710,000</td>
                    </tr>
                    <tr>
                        <td colspan="5" class="text-end fw-bold">PPN 11%</td>
                        <td>Rp. 3,378,100</td>
                    </tr>
                    <tr>
                        <td colspan="5" class="text-end fw-bold">TOTAL HARGA</td>
                        <td>Rp. 34,088,100</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <p><strong>Terbilang:</strong> "Tiga Puluh Empat Juta Delapan Puluh Delapan Ribu Seratus Rupiah"</p>

        <div class="mt-4">
            <p>Pembayaran dapat dilakukan berupa Transfer ke:</p>
            <p>Bank: BANK SYARIAH INDONESIA</p>
            <p>A/n.: PT. Multi Power Abadi</p>
            <p>A/c.: 8112728253</p>
        </div>

        <p>Jika sudah dilakukan pembayaran mohon konfirmasi ke multipowerabadi@gmail.com atau ke 0811272825 /
            081224272825</p>

        <div class="text-end mt-5">
            <p>Surabaya, 31 Desember 2024</p>
            <p><strong>(Mariyadi, ST. MM)</strong></p>
            <p>Direktur</p>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
