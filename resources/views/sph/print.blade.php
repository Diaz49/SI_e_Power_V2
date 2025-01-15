<html>

<head>
    <style type="text/css">
        .st_total {
            font-size: 10pt;
            font-weight: bold;
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
            font-size: 18pt;
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
    </style>

</head>

<body>
    @php
        \Carbon\Carbon::setLocale('id');
        $jumlahHarga = 0;
        $ppn = 0;
        $totalHarga = 0;

    @endphp
    @foreach ($sph->detailSph as $key => $detail)
        @php
            $jumlahHarga += $detail->jumlah_harga;
        @endphp
    @endforeach

    @php
        $totalHargaTerbilang = app('App\Http\Controllers\Sph\PrintSphController',)->angkaTerbilang($jumlahHarga);
    @endphp
    <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tbody>
            <tr>
                <td colspan="7">
                    <div align="center">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tbody>
                                <tr>
                                    <td colspan="14" rowspan="2" valign="top" class="style19b">
                                        <img src="{{ asset('img/mpa.png') }}" width="184" height="76"
                                            id="Image1"><br>
                                        <p class="par"><i>Jl. Gunung Anyar Tambak IV No.50 Surabaya</i></p>
                                    </td>
                                    <td width="2%">
                                        <div align="left" class="style9b">
                                            <div align="left" class="style19b"></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td height="63" class="style9">
                                        <div align="center"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="10%"></td>
                                    <td width="1%"></td>
                                    <td width="19%"></td>
                                    <td width="1%">&nbsp;</td>
                                    <td width="21%">&nbsp;</td>
                                    <td width="5%">&nbsp;</td>
                                    <td width="2%">&nbsp;</td>
                                    <td width="5%">&nbsp;</td>
                                    <td width="5%">&nbsp;</td>
                                    <td width="5%">&nbsp;</td>
                                    <td width="9%">&nbsp;</td>
                                    <td width="5%">&nbsp;</td>
                                    <td colspan="2">&nbsp;</td>
                                    <td class="style9">
                                        <div align="center"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="5" class="style9"><b>Surabaya,
                                            {{ \Carbon\Carbon::parse($sph->tanggal)->translatedFormat('d F Y') }}</b>
                                    </td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td colspan="2">&nbsp;</td>
                                    <td class="style9">
                                        <div align="center"></div>
                                    </td>
                                </tr>

                                <tr>
                                    <td><span class="style9">No. SPH</span></td>
                                    <td>:</td>
                                    <td colspan="12" class="style9">
                                        SPH{{ $sph->kode }}/Dir.01/MPA/II/{{ \Carbon\Carbon::parse($sph->tanggal)->translatedFormat('Y') }}
                                    </td>
                                    <td class="style9">
                                        <div align="center"></div>
                                    </td>
                                </tr>


                                <tr>
                                    <td class="style9">Lampiran</td>
                                    <td>:</td>
                                    <td colspan="5" class="style9">1 (Satu) Bundel</td>
                                    <td>&nbsp;</td>
                                    <td colspan="3">&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td colspan="2"><span class="style9"></span></td>
                                    <td class="style9">
                                        <div align="center"></div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td colspan="5">&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td colspan="3">&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td colspan="2"><span class="style9"></span></td>
                                    <td class="style9">
                                        <div align="center"></div>
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="7"><span class="style9">K e p a d a Yth,</span></td>
                                    <td>&nbsp;</td>
                                    <td colspan="3">&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td colspan="2"><span class="style9"></span></td>
                                    <td class="style9">
                                        <div align="center"></div>
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="14" class="style9"><b>{{ $sph->dataClient->nama_client }}</b></td>
                                    <td class="style9">
                                        <div align="center"></div>
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="14"><span class="style9"><b>{{ $sph->dataClient->alamat }}</b></span>
                                    </td>
                                    <td class="style9">
                                        <div align="center"></div>
                                    </td>
                                </tr>


                                <tr>
                                    <td colspan="14"></td>
                                    <td rowspan="2" class="style9">
                                        <div align="center"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="14"><span class="style9"><b>{{ $sph->dataClient->up_sph }}</b></span>
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
                                    <td colspan="3" class="style9">&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td colspan="2">&nbsp;</td>
                                    <td class="style9">
                                        <div align="center"></div>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="style9">Perihal</td>
                                    <td class="style9">:</td>
                                    <td colspan="12" class="style9">
                                        <div align="justify"><b>P{{ $sph->penawaran_harga }}
                                            </b></div>
                                    </td>
                                    <td class="style9">
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
                                    <td colspan="3" class="style9">&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td colspan="2">&nbsp;</td>
                                    <td class="style9">
                                        <div align="center"></div>
                                    </td>
                                </tr>


                                <tr>
                                    <td colspan="14" class="style9">Dengan Hormat,</td>
                                    <td class="style9">
                                        <div align="center"></div>
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="14" class="style9">Kami yang bertanda tangan di bawah ini :</td>
                                    <td class="style9">
                                        <div align="center"></div>
                                    </td>
                                </tr>



                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td class="style9">Nama </td>
                                    <td class="style9">:</td>
                                    <td colspan="10" class="style9"> <b>Mariyadi, ST. MM</b></td>
                                    <td class="style9">
                                        <div align="center"></div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td class="style9">Jabatan</td>
                                    <td class="style9">:</td>
                                    <td colspan="10" class="style9"><b>Direktur</b></td>
                                    <td class="style9">
                                        <div align="center"></div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td class="style9">Nama Perusahaan</td>
                                    <td class="style9">:</td>
                                    <td colspan="10" class="style9"><b>PT. Multi Power Abadi</b></td>
                                    <td class="style9">
                                        <div align="center"></div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td class="style9">Alamat Perusahaan </td>
                                    <td class="style9">:</td>
                                    <td colspan="10" class="style9"><b>Komplek Ruko Jl. Manyar Jaya No. 2i Lantai
                                            2</b></td>
                                    <td class="style9">
                                        <div align="center"></div>
                                    </td>
                                </tr>


                                <tr>
                                    <td colspan="14">
                                        <div align="justify"><span class="style9">Bermaksud memberikan
                                                {{ $sph->penawaran_harga }}. Sebesar, <b>Rp. {{ $jumlahHarga }},-&nbsp;
                                                    (Terbilang : {{$totalHargaTerbilang}} Rupiah)</b>, sudah termasuk PPh belum termasuk PPN 10%,
                                                dengan detail sebagai berikut : </span></div>
                                    </td>
                                    <td class="style9">
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

    <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
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
                    <div align="left">Project</div>
                    <div align="left"></div>
                </td>
                <td width="49" class="style6">
                    <div align="left">Qty</div>
                </td>
                <td width="64" class="style6">
                    <div align="left">Satuan</div>
                </td>
                <td width="153" class="style6">
                    <div align="left">Price (IDR)</div>
                </td>
                <td width="155" class="style6">
                    <div align="right">Total (IDR)</div>
                </td>
            </tr>
            <tr>
                <td colspan="6">
                    <hr>
                </td>
            </tr>
            @foreach ($sph->detailSph as $key => $detail)
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

    <table width="98%" align="center">

        <tbody>
            <tr>
                <td colspan="2" align="center" class="st_total">&nbsp;</td>
                <td width="217" align="right" class="st_total"> JUMLAH</td>
                <td width="152" align="right">
                    <div id="total" class="st_total" align="right">Rp.
                        {{ $jumlahHarga }} </div>
                </td>
            </tr>

        </tbody>
    </table>

    <table width="98%" border="0" align="center">



        <tbody>
            <tr>
                <td width="170">&nbsp;</td>
                <td width="11">
                </td>
                <td>&nbsp;</td>
                <td width="348">&nbsp;</td>
            </tr>

            <tr>
                <td width="170"><span class="style9">Ketentuan &amp; Syarat-syarat :</span></td>
                <td width="11"><span class="style9">-</span>
                </td>
                <td colspan="2"><span class="style9">Apabila barang yang dikirim tidak sesuai dengan kuantitas dan
                        kualitas pemesan, harus diganti/direject dan menjadi tanggung jawab Supplier.</span></td>
            </tr>

            <tr>
                <td width="170">&nbsp;</td>
                <td width="11"><span class="style9">-</span>
                </td>
                <td colspan="2"><span class="style9">Validasi Bahan/barang/material yang terkirim akan diperiksa
                        oleh kedua belah pihak.</span></td>
            </tr>

            <tr>
                <td width="170">&nbsp;</td>
                <td width="11"><span class="style9">-</span>
                </td>
                <td colspan="2"><span class="style9">Harga tersebut barang sudah terkirim sampai lokasi sesuai
                        pemesanan.</span></td>
            </tr>


            <tr>
                <td colspan="3">
                    <p class="style9">&nbsp;</p>
                </td>
                <td width="348">&nbsp;</td>
            </tr>


            <tr>
                <td colspan="3">
                    <p class="style9">Untuk detail Pekerjaan terlampir.</p>
                </td>
                <td width="348">&nbsp;</td>
            </tr>


            <tr>
                <td colspan="4">
                    <p class="style9">Demikian Surat Penawaran ini atas perhatiannya disampaikan terima kasih</p>
                </td>
            </tr>


            <tr>
                <td colspan="3">
                    <p class="style9"></p>
                </td>
                <td width="348">&nbsp;</td>
            </tr>


            <tr>
                <td colspan="3" class="style9">Hormat kami,</td>
                <td width="348">&nbsp;</td>
            </tr>

            <tr>
                <td colspan="3">&nbsp;</td>
                <td width="348">&nbsp;</td>
            </tr>

            <tr>
                <td colspan="3">&nbsp;</td>
                <td width="348">&nbsp;</td>
            </tr>


            <tr>
                <td colspan="3">&nbsp;</td>
                <td width="348">&nbsp;</td>
            </tr>

            <tr>
                <td colspan="3"><b class="style9">(<b><u> Mariyadi, ST. MM </u></b>)</b></td>
                <td width="348">&nbsp;</td>
            </tr>

            <tr>
                <td colspan="2"><b class="style9"><b>&nbsp;&nbsp;Direktur</b></b></td>
                <td>&nbsp;</td>
                <td width="348">&nbsp;</td>
            </tr>





        </tbody>
    </table>

    <div class="cetak no-print"><a href="" onclick="print();"><b>(Cetak)</b></a>
    </div>
</body>

</html>
