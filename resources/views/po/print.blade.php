<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>po</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @media print {
            .no-print {
                display: none !important;
            }
        }

        td,
        tr {
            padding: 0;
            margin: 0;
        }

        hr {
            margin: 5px;
            opacity: 5;
            width: 100%;
        }

        .style9 {
            color: #000000;
            font-size: 9pt;
            font-weight: normal;
            font-family: Arial;
        }

        .style6 {
            color: #000000;
            font-size: 10pt;
            font-weight: bold;
            font-family: Arial;
        }

        .small {
            font-size: small;
        }

        .st_total {

            font-size: 9pt;
            font-weight: bold;
            font-family: Verdana, Arial, Helvetica, sans-serif;
        }

        .st_under {
            font-size: 9pt;
            font-family: Verdana, Arial, Helvetica, sans-serif;

        }
    </style>
</head>

<body>
    @php
        \Carbon\Carbon::setLocale('id');
        $jumlahHarga = 0;
        $ppn = 0;
        $totalHarga = 0;
    @endphp
    <div class="mx-4 my-3">
        <div class="row">

            <div class="col-6">
                <img src="{{ asset('img/mpa.png') }}" alt="Company Logo" class="img-fluid mb-2"
                    style="max-width: 184px;">
            </div>

        </div>
        <p class="style9 fst-italic w-100"> Jl. Gunung Anyar Tambak IV No. 50 Surabaya<br></p>
        <table class="w-100">
            <tbody>
                <tr>
                    <td class="small" colspan="11">

                        <span
                            class="style9 fw-bold w-100">Surabaya,{{ \Carbon\Carbon::parse($po->tanggal_po)->translatedFormat('d F Y') }}</span>
                    </td>
                    <td>
                        <span class="style9 fs-6 fw-bolder text-dark fw-bolder">PURCHASE ORDER</span>

                    </td>


                </tr>
                <tr>
                    <td class="small"><span class="style9">No</span></td>
                    <td class="small">:</td>
                    <td colspan="4" class="small">
                        <span
                            class="style9 w-100">{{ $po->kode_po }}/Dir.01/PO/III/{{ \Carbon\Carbon::parse($po->tanggal_po)->translatedFormat('Y') }}</span>
                    </td>
                    <td colspan="5"></td>
                    <td class="small" colspan="2"><span class="style9"><strong>Buyer :
                                {{ $po->buyer }}</strong></span>
                    </td>

                </tr>
                <tr>
                    <td colspan="12" class="small">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="12" class="small"></td>
                </tr>

                <tr>
                    <td class="small" colspan="9"><span class="style9">Kepada Yth,<br>
                            <strong>
                                {{ $po->vendor->nama_vendor }} <br>
                                {{ $po->vendor->alamat_vendor }} <br>
                                {{ $po->vendor->kota }}
                            </strong>


                        </span></td>



                </tr>

                <tr>
                    <td class="small"><span class="style9">
                            Up
                        </span></td>
                    <td class="small">:</td>
                    <td class="small" colspan="3"><span class="style9">
                            <strong>
                                {{ $po->vendor->up }}
                            </strong>
                        </span></td>

                </tr>
                <tr>
                    <td class="small"><span class="style9">
                            Email
                        </span></td>
                    <td class="small">:</td>
                    <td class="small" colspan="3"><span class="style9">
                            <strong>

                                {{ $po->vendor->email }}
                            </strong>
                        </span></td>

                </tr>
                <tr>
                    <td class="small"><span class="style9">
                            Perihal
                        </span></td>
                    <td class="small">:</td>
                    <td class="small" colspan="3"><span class="style9">
                            <strong>

                                {{ $po->perihal }}
                            </strong>
                        </span></td>

                </tr>
                <tr>
                    <td class="small"><span class="style9"><strong></span></td>
                    <td class="small"></td>
                    <td class="small" colspan="3"><span class="style9">
                        </span></td>


                </tr>


            </tbody>
        </table>


        <div class="mt-4">
            <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                <tbody>
                    <tr>
                        <td colspan="6">
                            <hr>
                        </td>
                    </tr>
                    <tr>
                        <td width="40" class="style6">
                            <div align="center">No</div>
                        </td>
                        <td width="696" class="style6">
                            <div align="left">Deskripsi</div>
                            <div align="left"></div>
                        </td>
                        <td width="49" class="style6">
                            <div align="left">Qty</div>
                        </td>
                        <td width="64" class="style6">
                            <div align="left">Satuan</div>
                        </td>
                        <td width="153" class="style6">
                            <div align="left">Harga</div>
                        </td>
                        <td width="155" class="style6">
                            <div align="right">Jumlah</div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6">
                            <hr>
                        </td>
                    </tr>
                    @foreach ($po->detail as $key => $detail)
                        @php
                            $jumlahHarga += $detail->jumlah_harga;
                        @endphp
                        <tr>
                            <td class="style9" align="center">{{ $key + 1 }}.</td>
                            <td class="style9">{{ $detail->nama_barang }}</td>
                            <td class="style9" align="left">{{ $detail->qty }}</td>
                            <td class="style9" align="left">{{ $detail->satuan }}</td>
                            <td class="style9" align="left">Rp.
                                {{ number_format(floor($detail->harga_satuan), 0, ',', '.') }}</td>
                            <td class="style9" align="right">
                                Rp.{{ number_format(floor($detail->jumlah_harga), 0, ',', '.') }}</td>
                        </tr>
                    @endforeach


                    <tr>
                        <td colspan="6">
                            <hr>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <table width="100%" align="center" cellpadding="0" cellspacing="0">

            <tbody>
                <tr>
                    <td colspan="2" align="center" class="st_total">&nbsp;</td>
                    <td width="215" align="left">
                        <a href=""
                            class="link-dark link-offset-3 link-underline-opacity-100 link-underline-dark"><span
                                class="st_total">JUMLAH <br></span></a>
                    </td>
                    <td width="154" align="right">
                        <div id="total" class="st_total" align="right">Rp.
                            {{ number_format(floor($jumlahHarga), 0, ',', '.') }}
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center" class="st_total">&nbsp;</td>
                    <td width="215" align="left">

                        <span class="st_under">DISKON </span>
                    </td>
                    <td width="154" align="right">
                        <div id="total" class="st_under" align="right">Rp.
                            {{ number_format(floor($po->diskon), 0, ',', '.') }}
                        </div>
                    </td>
                </tr>

                <tr>
                    @php
                        $hargaDiskon = $jumlahHarga - $po->diskon;
                    @endphp
                    <td colspan="2" align="center" class="st_total">&nbsp;</td>
                    <td align="left" class="st_total">
                        <a href=""
                            class="link-dark link-offset-3 link-underline-opacity-100 link-underline-dark"><span
                                class="st_total">TOTAL<br></span></a>

                    </td>
                    <td width="154" align="right">
                        <div id="total" class="st_total" align="right">Rp.
                            {{ number_format(floor($hargaDiskon), 0, ',', '.') }}
                        </div>
                    </td>
                </tr>
                <tr>
                    @php
                        $ppn = ($hargaDiskon * 11) / 100;
                    @endphp
                    <td colspan="2" align="center" class="st_total">&nbsp;</td>
                    <td align="left" class="st_under">PPN 11%</td>
                    <td width="154" align="right">
                        <div id="total" class="st_under" align="right">Rp.
                            {{ number_format(floor($ppn), 0, ',', '.') }}
                        </div>
                    </td>
                </tr>

                <tr>
                    @php
                        $totalHarga = $hargaDiskon + $ppn;

                    @endphp
                    <td width="383" align="right" class="st_total">&nbsp;</td>
                    <td width="384" colspan="-2" align="center" class="st_total">&nbsp;</td>
                    <td align="left" class="st_total">
                        <a href=""
                            class="link-dark link-offset-3 link-underline-opacity-100 link-underline-dark"><span
                                class="st_total">GRAND TOTAL<br></span></a>
                    </td>
                    <td width="154" align="right">
                        <div id="total" class="st_total" align="right">Rp.
                            {{ number_format(floor($totalHarga), 0, ',', '.') }}


                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="w-100">
            <tbody>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>
                        <a href="" class="link-dark link-offset-1 link-underline-opacity-100 link-underline-dark fst-italic">
                            <span class="style9">
                                <b>Catatan :</b></span>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td><span class="style9"><i>-</i></span>
                    </td>

                </tr>

                <tr>
                    <td>&nbsp;</td>

                </tr>

                <tr>

                    <td width="50%">
                        <div align="center" class="style9"><b>PT. MULTI POWER ABADI</b>
                        </div>
                    </td>

                    <td width="50%">
                        <div align="center" class="style9">
                            <div align="center" class="style9"> <b>{{ $po->vendor->nama_vendor }}</b>
                            </div>

                        </div>
                    </td>
                </tr>
                <tr>
                    <td height="94">&nbsp;</td>
                    <td>
                        <p><span class="style19b"></span></p>
                        <center>
                            <center>

                                <div alt="" width="184" height="91" class="post-img" align="middle">
                                </div>


                            </center>
                        </center>
                        <p></p>
                    </td>
                </tr>
                <tr>

                    <td>
                        <div align="center" class="style9"><b>(<b><u> Mariyadi, ST. MM </u></b>)</b></div>
                    </td>

                    <td>
                        <div align="center" class="style9"><b>
                                <div align="center" class="style9"><b>(<b><u>______________________</u></b>)</b></div>
                            </b></div>
                    </td>
                </tr>

                <tr>

                    <td>
                        <div align="center" class="style9"><b> Direktur</b></div>
                    </td>
                    <td>
                        <div align="center" class="style9"><b>
                                <div align="center" class="style9"></div>
                            </b></div>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="text-center mt-5 no-print">
            <button onclick="window.print()" class="btn btn-primary">Cetak po</button>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
