<html>

<head>
    <style type="text/css">
        .st_total {
            font-size: 10pt;
            font-family: Verdana, Arial, Helvetica, sans-serif;
        }

        .cetak {
            margin-top: 40px;
            text-align: center;
        }

        @media print {
            .no-print {
                display: none !important;
            }
        }

        .style6 {
            color: #000000;
            font-size: 10pt;
            font-weight: bold;
            font-family: Arial;
        }

        .style9 {
            color: #000000;
            font-size: 10pt;
            font-weight: normal;
            font-family: Arial;
        }

        .style9b {
            color: #000000;
            font-size: 10pt;
            font-weight: bold;
            font-family: Arial;
        }

        .style19b {
            color: #000000;
            font-size: 12pt;
            font-weight: bold;
            font-family: Arial;
        }

        .style10b {
            color: #000000;
            font-size: 12pt;
            font-weight: bold;
            font-family: Arial;
        }

        .par {
            color: #000000;
            font-size: 10pt;
            font-weight: normal;
            font-family: Arial;
            margin-top: 3;
        }

        .left {
            text-align: left;
        }

        .st_total1 {
            font-size: 10pt;
            font-weight: bold;
            font-family: Verdana, Arial, Helvetica, sans-serif;
        }
    </style>

</head>

<body">
    @php
        \Carbon\Carbon::setLocale('id');
        $jumlahHarga = 0;
        $ppn = 0;
        $totalHarga = 0;
    @endphp
    <table width="98%" border="1" align="center" cellpadding="0" cellspacing="0">
        <tbody>
            <tr>
                <td colspan="7">
                    <div align="center">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tbody>
                                <tr>
                                    <td colspan="3" rowspan="2" valign="top" class="style19b">
                                        &nbsp;
                                        @if ($invoice->pt->nama_pt === 'Multi Power Abadi')
                                            <img src="{{ asset('img/mpa.png') }}" alt="Company Logo"
                                                class="img-fluid mb-2" style="max-width: 184px;">
                                        @elseif($invoice->pt->nama_pt === 'Rajata Wedding')
                                            <img src="{{ asset('img/rajata.png') }}" alt="Company Logo"
                                                class="img-fluid mb-2" style="max-width: 184px;">
                                        @elseif($invoice->pt->nama_pt === 'Nainsmedia')
                                            <img src="{{ asset('img/nainsmedia.png') }}" alt="Company Logo"
                                                class="img-fluid mb-2" style="max-width: 184px;">
                                        @elseif($invoice->pt->nama_pt === 'Ramada Event Organizer')
                                            <img src="{{ asset('img/ramada.png') }}" alt="Company Logo"
                                                class="img-fluid mb-2" style="max-width: 184px;">
                                        @elseif($invoice->pt->nama_pt === 'MARK')
                                            <img src="{{ asset('img/mark.png') }}" alt="Company Logo"
                                                class="img-fluid mb-2" style="max-width: 150px;">
                                        @elseif($invoice->pt->nama_pt === 'Multi Creation')
                                            <img src="{{ asset('img/multicreation.png') }}" alt="Company Logo"
                                                class="img-fluid mb-2" style="max-width: 184px;">
                                        @endif
                                        <br>
                                        <p class="par"><i>&nbsp;Jl. Gunung Anyar Tambak IV No.50 Surabaya</i></p>
                                    </td>
                                    <td colspan="4" valign="top" class="style19b">&nbsp;</td>
                                    <td width="10%" valign="top" class="style19b">&nbsp;</td>
                                    <td width="13%" valign="top" class="style19b"><strong
                                            class="style19b"><u>KWITANSI </u></strong></td>
                                    <td colspan="2">
                                        <div align="left" class="style9b">
                                            <div align="left" class="style19b"></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="14"></td>
                                    <td rowspan="2" class="style9">
                                        <div align="center"></div>
                                    </td>
                                </tr>

                                <tr>

                                    <td class="style9">&nbsp;</td>

                                    <td class="style9" align="right">&nbsp;</td>
                                </tr>
                                <tr>

                                    <td class="style9">&nbsp;</td>

                                    <td class="style9" align="right">&nbsp;</td>

                                </tr>
                                <tr>
                                    <td width="22%" colspan="1"><span class="st_total">&nbsp;No. Kwitansi</span>
                                    </td>
                                    <td width="1%">:</td>
                                    <td colspan="12"><span
                                            class="style9">{{ $invoice->pt->kode_pt }}{{ $invoice->kode }}/Dir.01/KWT/XII/{{ \Carbon\Carbon::parse($invoice->tgl_invoice)->translatedFormat('Y') }}</span>
                                    </td>
                                    <td width="1%" class="style9">
                                        <div align="center"></div>
                                    </td>
                                </tr>

                                <tr>
                                    <td width="22%" colspan="1"><span class="st_total">&nbsp;Sudah terima
                                            dari</span></td>
                                    <td width="1%">:</td>
                                    <td colspan="12"><span class="style9">{{ $invoice->client->nama_client }}</span>
                                    </td>
                                    <td width="1%" class="style9">
                                        <div align="center"></div>
                                    </td>
                                </tr>


                                <tr>
                                    <td width="22%" colspan="1"><span class="st_total">&nbsp;Untuk
                                            Pembayaran</span></td>
                                    <td width="1%">:</td>

                                </tr>
                                @foreach ($invoice->detail as $key => $detail)
                                    <tr>
                                        <td class="style9" align="left"><span class="st_total">&nbsp;</span></td>
                                        <td colspan="12"><span class="style9">&nbsp;&nbsp;&nbsp;&nbsp;-
                                                &nbsp;{{ $detail->nama_barang }}</span></td>

                                    </tr>
                                @endforeach

                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td colspan="10">&nbsp;</td>
                                    <td class="style9">
                                        <div align="center"></div>
                                    </td>
                                </tr>
                                @foreach ($invoice->detail as $key => $detail)
                                    @php
                                        $jumlahHarga += $detail->jumlah_harga;
                                    @endphp
                                @endforeach
                                @php
                                    $ppn = $jumlahHarga * (11 / 100);
                                    $totalHarga = $jumlahHarga + $ppn;
                                    $totalHargaTerbilang = app(
                                        'App\Http\Controllers\Invoice\PrintInvoiceController',
                                    )->angkaTerbilang($totalHarga);
                                @endphp
                                <tr>
                                    <td><span class="st_total">&nbsp;Terbilang</span></td>
                                    <td>:</td>

                                    <td colspan="11"><span class="style9"><i>{{ $totalHargaTerbilang }}
                                                Rupiah.</i></span></td>
                                    <td class="style9">
                                        <div align="center"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td colspan="10">&nbsp;</td>
                                    <td class="style9">
                                        <div align="center"></div>
                                    </td>
                                </tr>

                                <tr>
                                    <td><span class="st_total">&nbsp;Jumlah</span></td>
                                    <td>:</td>
                                    <td colspan="3" class="st_total"><b><u>Rp.</u></b>


                                        <b><u> {{ number_format(floor($totalHarga), 0, ',', '.') }}
                                            </u></b>
                                    </td>
                                    <td colspan="10" class="style9b"><b>Surabaya,
                                            {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</b>
                                        <div align="center"></div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td colspan="6">
                                        <div align="center"></div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td colspan="6">
                                        <div align="center"></div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td colspan="6">
                                        <div align="center"></div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td colspan="4"><span class="style9"><b>(<b><u> Septania Virgia Naruthama
                                                    </u></b>)</b></span></td>
                                    <td colspan="6">
                                        <div align="center"></div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td colspan="4"><span
                                            class="st_total">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Direktur</span>
                                    </td>
                                    <td colspan="6">
                                        <div align="center"></div>
                                    </td>
                                </tr>



                            </tbody>
                        </table>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>

    <div align="center" class="style9"></div>
    <div align="center" class="style9">

    </div>
    <div align="center" class="style9"></div>



    <div align="center" class="style9"><b>
            <div align="center" class="style9"></div>
        </b></div>
    <div align="center" class="style9"></div>
    <div align="center" class="style9"><b>
            <div align="center" class="style9"></div>
        </b></div>
    &nbsp;



    <div class="cetak no-print"><a href="" onclick="print();"><b>(Cetak)</b></a>
    </div>
    <table width="98%" align="center">


    </table>
    </body>

</html>
