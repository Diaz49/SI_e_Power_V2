<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
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
                @if ($invoice->pt->nama_pt === 'Multi Power Abadi')
                    <img src="{{ asset('img/mpa.png') }}" alt="Company Logo" class="img-fluid mb-2"
                        style="max-width: 184px;">
                @elseif($invoice->pt->nama_pt === 'Rajata Wedding')
                    <img src="{{ asset('img/rajata.png') }}" alt="Company Logo" class="img-fluid mb-2"
                        style="max-width: 184px;">
                @elseif($invoice->pt->nama_pt === 'Nainsmedia')
                    <img src="{{ asset('img/nainsmedia.png') }}" alt="Company Logo" class="img-fluid mb-2"
                        style="max-width: 184px;">
                @elseif($invoice->pt->nama_pt === 'Ramada Event Organizer')
                    <img src="{{ asset('img/ramada.png') }}" alt="Company Logo" class="img-fluid mb-2"
                        style="max-width: 184px;">
                @elseif($invoice->pt->nama_pt === 'MARK')
                    <img src="{{ asset('img/mark.png') }}" alt="Company Logo" class="img-fluid mb-2"
                        style="max-width: 150px;">
                @elseif($invoice->pt->nama_pt === 'Multi Creation')
                    <img src="{{ asset('img/multicreation.png') }}" alt="Company Logo" class="img-fluid mb-2"
                        style="max-width: 184px;">
                @endif

            </div>
            <div class="col-6 d-flex justify-content-end align-items-center">
                <p><a href="#"
                        class="fs-2 fw-bolder text-dark link-underline-dark link-underlinelink-offset-2 link-underline-opacity-100 ">INVOICE</a>
                </p>
            </div>

        </div>
        <p class="style9 fst-italic w-100"> Jl. Gunung Anyar Tambak IV No. 50<br>
            Kelurahan Gunung Anyar Kec. Gunung Anyar Kota Surabaya Jawa Timur 60249<br>
            Email: <strong>multipowerabadi@gmail.com</strong><br>
            Telp: 031-59178774 & Hp: 0811272825<br>
            NPWP: 71.425.962.9-606.000<br></p>

        <table class="w-100">
            <tbody>
                <tr>
                    <td class="small"><span class="style9"><strong>Kepada</strong></span></td>
                    <td class="small">:</td>
                    <td class="small" colspan="3"><span class="style9">{{ $invoice->client->nama_client }}</span>
                    </td>

                    <td class="small" width="1%">&nbsp;</td>
                    <td class="small" colspan="2"><span class="style9"><strong>No. Invoice</strong></span>
                    </td>
                    <td class="small">:</td>
                    <td class="small" colspan="2"><span
                            class="style9">{{ $invoice->pt->kode_pt }}{{ $invoice->kode }}/Dir.01/INV/XII/{{ \Carbon\Carbon::parse($invoice->tgl_invoice)->translatedFormat('Y') }}</span>
                    </td>
                    <td class="small">
                    </td>
                </tr>

                <tr>
                    <td class="small"><span class="style9"><strong>
                                Alamat
                            </strong></span></td>
                    <td class="small">:</td>
                    <td class="small" colspan="3"><span class="style9">
                            {{ $invoice->client->alamat }}
                        </span></td>
                    <td class="small">&nbsp;</td>
                    <td class="small" colspan="2"><span class="style9"><strong>Tgl. Invoice</strong></span></td>
                    <td class="small">:</td>
                    <td class="small" colspan="2"><span
                            class="style9">{{ \Carbon\Carbon::parse($invoice->tgl_invoice)->translatedFormat('d F Y') }}</span>
                    </td>
                    <td class="small">
                    </td>

                </tr>
                <tr>
                    <td class="small"><span class="style9"><strong></strong></span></td>
                    <td class="small"></td>
                    <td class="small" colspan="3"><span class="style9">
                        </span></td>
                    <td class="small">&nbsp;</td>
                    <div></div>
                    <td class="small" colspan="2"><span class="style9"><strong>Due Date Inv.</strong></span></td>
                    <td class="small">:</td>
                    <td class="small" colspan="2"><span
                            class="style9">{{ \Carbon\Carbon::parse($invoice->due)->translatedFormat('d F Y') }}</span>
                    </td>
                    <td class="small">
                    </td>

                </tr>
                <tr>

                    <td width="7%" colspan="1">&nbsp;</td>
                    <td width="1%">&nbsp;</td>
                    <td colspan="3"><span class="style9"><strong>Up.
                                {{ $invoice->client->up_invoice }}</strong></span>
                    </td>
                    <td>&nbsp;</td>
                    <td colspan="2" class="style9">&nbsp;</td>
                    <td>&nbsp;</td>
                    <td colspan="2">&nbsp;</td>

                </tr>
                <tr>

                    <td colspan="5"><em class="style9"><u><strong>Reference :</strong></u></em></td>
                    <td>&nbsp;</td>
                    <td colspan="2" class="style9">&nbsp;</td>
                    <td>&nbsp;</td>
                    <td colspan="2">&nbsp;</td>

                </tr>
                <tr>

                    <td class="small">&nbsp;</td>
                    <td class="small"></td>
                    <td colspan="2" class="small"><span
                            class="style9"><u><b>No.&nbsp;{{ $invoice->jenis_no }}</b></u></span></td>
                    <td width="22%" class="small"><span class="style9"><u><b>No. BAST</b></u></span></td>
                    <td class="small">&nbsp;</td>
                    <td colspan="2" class="small">&nbsp;</td>
                    <td class="small">&nbsp;</td>
                    <td colspan="2" class="small">&nbsp;</td>
                    <td class="style9">
                        <div align="center"></div>
                    </td>

                </tr>

                <tr class="align-top">
                    <td class="small">&nbsp;</td>
                    <td class="small"></td>
                    <td colspan="2" class="small">

                        @if ($invoice->no_1 != '')
                            <span class="style9">{{ $invoice->no_1 }}</span><br>
                        @endif
                        @if ($invoice->no_2 != '')
                            <span class="style9">{{ $invoice->no_2 }}</span><br>
                        @endif
                        @if ($invoice->no_3 != '')
                            <span class="style9">{{ $invoice->no_3 }}</span><br>
                        @endif
                        @if ($invoice->no_4 != '')
                            <span class="style9">{{ $invoice->no_4 }}</span><br>
                        @endif
                        @if ($invoice->no_5 != '')
                            <span class="style9">{{ $invoice->no_5 }}</span><br>
                        @endif
                    </td>
                    <td width="22%" class="small">
                        @if ($invoice->no_bast_1 != '')
                            <span class="style9">{{ $invoice->no_bast_1 }}</span><br>
                        @endif
                        @if ($invoice->no_bast_2 != '')
                            <span class="style9">{{ $invoice->no_bast_2 }}</span><br>
                        @endif
                        @if ($invoice->no_bast_3 != '')
                            <span class="style9">{{ $invoice->no_bast_3 }}</span><br>
                        @endif
                        @if ($invoice->no_bast_4 != '')
                            <span class="style9">{{ $invoice->no_bast_4 }}</span><br>
                        @endif
                        @if ($invoice->no_bast_5 != '')
                            <span class="style9">{{ $invoice->no_bast_5 }}</span>
                        @endif
                    </td>
                    <td class="small">&nbsp;</td>
                    <td colspan="2" class="small">&nbsp;</td>
                    <td class="small">&nbsp;</td>
                    <td colspan="2" class="small">&nbsp;</td>
                    <td class="style9">
                        <div align="center"></div>
                    </td>

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
                    @foreach ($invoice->detail as $key => $detail)
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
                    <td width="215" align="right" class="st_total">TOTAL HARGA</td>
                    <td width="154" align="right">
                        <div id="total" class="st_total" align="right">Rp.
                            {{ number_format(floor($jumlahHarga), 0, ',', '.') }}
                        </div>
                    </td>
                </tr>
                <tr>
                    @php
                        $totalHargaTerbilang = app(
                            'App\Http\Controllers\Invoice\PrintInvoiceController',
                        )->angkaTerbilang($jumlahHarga);
                    @endphp
                    <td colspan="4" align="right" class="style9">
                        <br><i><b>Terbilang : </b>"{{ $totalHargaTerbilang }} Rupiah"</i>
                        <div id="total" class="st_total" align="right"></div>
                    </td>
                </tr>


            </tbody>
        </table>
        <table>
            <tbody>
                <tr>
                    <td colspan="4">&nbsp;</td>
                    <td width="330" colspan="3">&nbsp;</td>
                </tr>

                <tr>
                    <td colspan="4"><span class="style9"><i><b>Pembayaran dapat dilakukan berupa Transfer ke:
                                </b></i></span></td>
                    <td width="330" colspan="3">&nbsp;</td>
                </tr>

                <tr>
                    <td width="462"><span class="style9"><i><b>Bank &nbsp;:
                                    {{ $invoice->bank->nama_bank }}</b></i></span>
                    </td>
                    <td width="109">
                    </td>
                    <td colspan="2">&nbsp;</td>
                    <td width="330" colspan="3">&nbsp;</td>
                </tr>

                <tr>
                    <td width="462"><span class="style9"><i><b>A/n. &nbsp;&nbsp; :
                                    {{ $invoice->bank->nama_rek }}</b></i></span>
                    </td>
                    <td colspan="2">&nbsp;</td>
                    <td width="330" colspan="3">&nbsp;</td>
                </tr>
                <tr>
                    <td width="462"><span class="style9"><i><b>A/c. &nbsp;&nbsp; :
                                    {{ $invoice->bank->nomer_rek }}</b></i></span></td>
                    <td colspan="2">&nbsp;</td>
                    <td width="330" colspan="3">&nbsp;</td>
                </tr>
                <tr>
                    <td width="462">&nbsp;</td>
                    <td colspan="2">&nbsp;</td>
                    <td width="330" colspan="3">&nbsp;</td>
                </tr>

                <tr>
                    <td colspan="4"><span class="style9"><i>Jika sudah di lakukan pembayaran mohon konfirmasi ke
                                <b>multipowerabadi@gmail.com</b></i></span></td>
                    <td width="330" colspan="3">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="2"><span class="style9"><i>atau ke 0811272825 / 081224272825</i></span></td>
                    <td colspan="2">&nbsp;</td>
                    <td width="330" colspan="3">&nbsp;</td>
                </tr>

                <tr>
                    <td colspan="2">&nbsp;</td>
                    <td colspan="2">&nbsp;</td>
                    <td width="330" colspan="3">&nbsp;</td>
                </tr>
                <tr>
                    <td>
                        <div align="center" class="style9"></div>
                    </td>
                    <td colspan="2">
                        <div align="center" class="style9">
                            <p>&nbsp;</p>
                        </div>
                    </td>
                    <td colspan="3">
                        <div align="center" class="style9"><b>Surabaya,
                                {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</b>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td height="94">&nbsp;</td>
                    <td colspan="2">&nbsp;</td>
                    <td colspan="3">
                        <p><span class="style19b"></span></p>
                        <center>
                            <center>
                                @if ($invoice->ttd === 'true')
                                    <img src="{{ asset('img/ttddanstemp.png') }}" alt="" width="184"
                                        height="91" class="post-img" align="middle" img="disable">
                                @else
                                    <div alt="" width="184" height="91" class="post-img"
                                        align="middle"></div>
                                @endif

                            </center>
                        </center>
                        <p></p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div align="center" class="style9"><b>
                                <div align="center" class="stylaze9"></div>
                            </b></div>
                        <div align="center" class="style9"></div>
                    </td>
                    <td colspan="2">
                        <div align="center" class="style9"><b>
                                <div align="center" class="style9"></div>
                            </b></div>
                    </td>
                    <td colspan="3">
                        <div align="center" class="style9"><b>(<b><u> Mariyadi, ST. MM </u></b>)</b></div>
                    </td>
                </tr>

                <tr>
                    <td>
                        <div align="center" class="style9"><b>
                                <div align="center" class="style9"></div>
                            </b></div>
                        <div align="center" class="style9"></div>
                    </td>
                    <td colspan="2">
                        <div align="center" class="style9"><b>
                                <div align="center" class="style9"></div>
                            </b></div>
                    </td>
                    <td colspan="3">
                        <div align="center" class="style9"><b> Direktur</b></div>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="text-center mt-5 no-print">
            <button onclick="window.print()" class="btn btn-primary">Cetak Invoice</button>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
