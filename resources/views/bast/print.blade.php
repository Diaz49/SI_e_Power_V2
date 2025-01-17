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
            font-size: 9pt;
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

    @endphp
    <div class="cetak no-print"><a href="" onclick="print();"><b>(Cetak)</b></a>
    </div>


    <div align="center">
        <table width="91%" border="0" align="center" cellpadding="0" cellspacing="0">
            <tbody>
                <tr>
                    <td colspan="7">
                        <div align="center">
                            <table width="90%" border="0" cellspacing="0" cellpadding="0">

                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td width="2%"></td>
                                        <td width="19%">&nbsp;</td>
                                        <td width="1%">&nbsp;</td>
                                        <td width="38%">&nbsp;</td>
                                        <td width="2%">&nbsp;</td>
                                        <td width="5%">&nbsp;</td>
                                        <td width="5%">&nbsp;</td>
                                        <td width="5%">&nbsp;</td>
                                        <td width="3%">&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td width="10%" class="style9">
                                            <div align="center"></div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td width="2%"></td>
                                        <td width="19%">&nbsp;</td>
                                        <td width="1%">&nbsp;</td>
                                        <td width="38%">&nbsp;</td>
                                        <td width="2%">&nbsp;</td>
                                        <td width="5%">&nbsp;</td>
                                        <td width="5%">&nbsp;</td>
                                        <td width="5%">&nbsp;</td>
                                        <td width="3%">&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td width="10%" class="style9">
                                            <div align="center"></div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="13">
                                            <div align="center"><strong class="style19b"><u>BERITA ACARA SERAH
                                                        TERIMA</u></strong></div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td width="2%"></td>
                                        <td width="19%">&nbsp;</td>
                                        <td width="1%">&nbsp;</td>
                                        <td width="38%">&nbsp;</td>
                                        <td width="2%">&nbsp;</td>
                                        <td width="5%">&nbsp;</td>
                                        <td width="5%">&nbsp;</td>
                                        <td width="5%">&nbsp;</td>
                                        <td width="3%">&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td width="10%" class="style9">
                                            <div align="center"></div>
                                        </td>
                                    </tr>



                                    <tr>
                                        <td colspan="13">
                                            <div align="center" class="style10b">NO BAST :
                                                {{ $bast->invoice->no_bast_1 }}</div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td width="2%"></td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td width="10%" class="style9">
                                            <div align="center"></div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td width="2%"></td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td width="10%" class="style9">
                                            <div align="center"></div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td width="2%"></td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td width="10%" class="style9">
                                            <div align="center"></div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td width="2%"></td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td width="10%" class="style9">
                                            <div align="center"></div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="13">
                                            <div align="left" class="style9">
                                                <div align="justify">Pada hari ini <span class="style9">
                                                        {{ \Carbon\Carbon::parse($bast->tanggal)->locale('id')->translatedFormat('l') }}</span>&nbsp;tanggal
                                                    <span class="style9">
                                                        {{ \Carbon\Carbon::parse($bast->tanggal)->translatedFormat('d') }}</span>
                                                    bulan <span class="style9">
                                                        {{ \Carbon\Carbon::parse($bast->tanggal)->locale('id')->translatedFormat('F') }}</span>
                                                    tahun <span class="style9">
                                                        {{ \Carbon\Carbon::parse($bast->tanggal)->translatedFormat('Y') }}</span>,
                                                    kami yang bertanda tangan di bawah ini :
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td width="3%" colspan="1">&nbsp;</td>
                                        <td width="6%">&nbsp;</td>
                                        <td colspan="4">&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td colspan="3">&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>



                                    <tr>
                                        <td><span class="style9">1.</span></td>
                                        <td><span class="style9">Nama</span></td>
                                        <td width="2%">:</td>
                                        <td colspan="10" class="style9"><b>{{ $bast->nama }}</b>
                                            <div align="center"></div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td></td>
                                        <td><span class="style9">Jabatan</span></td>
                                        <td width="2%">:<span class="style9"></span></td>
                                        <td colspan="10" class="style9"><b>{{ $bast->jabatan }}</b>
                                            <div align="center"></div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td width="2%"></td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td width="10%" class="style9">
                                            <div align="center"></div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="12"></td>
                                        <td rowspan="2" class="style9">
                                            <div align="center"></div>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td colspan="13">
                                            <div align="justify" class="style9">Dalam hal ini bertindak untuk dan atas
                                                nama {{ $bast->invoice->client->nama_client }} ; dan</div>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td colspan="12"></td>
                                        <td rowspan="2" class="style9">
                                            <div align="center"></div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td width="3%" colspan="1">&nbsp;</td>
                                        <td width="6%">&nbsp;</td>
                                        <td colspan="4">&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td colspan="3">&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>

                                    <tr>
                                        <td><span class="style9">2.</span></td>
                                        <td><span class="style9">Nama</span></td>
                                        <td colspan="4">:<span class="style9"> &nbsp;<b>Mariyadi</b></span></td>
                                        <td>&nbsp;</td>
                                        <td colspan="3">&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td class="style9">
                                            <div align="center"></div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>&nbsp;</td>
                                        <td><span class="style9">Jabatan</span></td>
                                        <td colspan="4">:<span class="style9">&nbsp;<b> Direktur</b></span></td>
                                        <td>&nbsp;</td>
                                        <td colspan="3">&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td class="style9">
                                            <div align="center"></div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="12"></td>
                                        <td rowspan="2" class="style9">
                                            <div align="center"></div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td width="3%" colspan="1">&nbsp;</td>
                                        <td width="6%">&nbsp;</td>
                                        <td colspan="4">&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td colspan="3">&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>

                                    <tr>
                                        <td colspan="13">
                                            <div align="left" class="style9">
                                                <div align="justify">Dalam hal ini bertindak untuk dan atas nama PT.
                                                    Multi Power Abadi yang selanjutnya disebut "Mitra / Rekanan"</div>
                                            </div>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td colspan="12"></td>
                                        <td rowspan="2" class="style9">
                                            <div align="center"></div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td width="3%" colspan="1">&nbsp;</td>
                                        <td width="6%">&nbsp;</td>
                                        <td colspan="4">&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td colspan="3">&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>

                                    <tr>
                                        <td colspan="4" class="style9">
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Berdasarkan :</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td colspan="3">&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td class="style9">
                                            <div align="center"></div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="12"></td>
                                        <td rowspan="2" class="style9">
                                            <div align="center"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="3%" colspan="1">&nbsp;</td>
                                        <td width="6%">&nbsp;</td>
                                        <td colspan="4">&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td colspan="3">&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    @foreach ($bast->invoice->detail as $key => $detail)
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td class="style9">
                                                <div align="center">
                                                    <blockquote>
                                                        <p>{{ $key + 1 }}.</p>
                                                    </blockquote>
                                                </div>
                                            </td>
                                            <td colspan="11" class="style9">
                                                <div align="justify">{{ $bast->invoice->jenis_no }} No.
                                                    {{ $bast->invoice->no_1 }} tentang
                                                    {{ $detail->nama_barang }}.
                                                </div>
                                                <div align="justify"></div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td class="style9">
                                            <div align="center">
                                                &nbsp;
                                            </div>
                                        </td>
                                        <td colspan="11" class="style9">
                                            <div align="justify">Disepakati harga pengadaan
                                                barang dan atau Jasa dengan rincian
                                                sebagai berikut :
                                            </div>
                                            <div align="justify"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td colspan="11">
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
                                        <td colspan="3">&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
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

    </div>


    <table width="82%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tbody>
            <tr>
                <td colspan="6">
                    <hr>
                </td>
            </tr>
            <tr>
                <td width="26" class="style6">
                    <div align="justify">No</div>
                </td>
                <td width="571" class="style6">
                    <div align="left">Item Pekerjaan</div>
                    <div align="left"></div>
                </td>
                <td width="31" class="style6">
                    <div align="center">Qty</div>
                </td>
                <td width="58" class="style6">
                    <div align="center">Satuan</div>
                </td>
                <td width="133" class="style6">
                    <div align="right">Harga Satuan</div>
                </td>
                <td width="149" class="style6">
                    <div align="right">Jumlah</div>
                </td>
            </tr>
            <tr>
                <td colspan="6">
                    <hr>
                </td>
            </tr>

            @foreach ($bast->invoice->detail as $key => $detail)
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



    <table width="82%" align="center">

        <tbody>
            <tr>
                <td colspan="2" align="center" class="st_total">&nbsp;</td>
                <td width="243" align="right" class="style9b">Total</td>
                <td width="126" align="right">
                    <div id="total" class="style9b" align="right">
                        Rp. {{ number_format(floor($jumlahHarga), 0, ',', '.') }}</div>
                </td>
            </tr>


        </tbody>
    </table>

    <table width="82%" border="0" align="center">


        <tbody>
            <tr>
                <td colspan="9">&nbsp;</td>
                <td width="186">&nbsp;</td>
                <td width="508">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="9">&nbsp;</td>
                <td width="186">&nbsp;</td>
                <td width="508">&nbsp;</td>
            </tr>


            <tr>
                <td colspan="19">
                    <div align="left" class="style9">
                        <div align="justify"><span class="style9">Telkomsel dan Mitra/Rekanan menyatakan sebagai
                                berikut :</span></div>
                    </div>
                </td>
            </tr>

            <tr>
                <td colspan="9">&nbsp;</td>
                <td width="186">&nbsp;</td>
                <td width="508">&nbsp;</td>
            </tr>

            <tr>
                <td width="25" class="style9">
                    <div align="right">1.</div>
                </td>
                <td colspan="10" class="style9">
                    <div align="justify">Mitra/Rekanan telah menyerahkan pekerjaan Kepada {{$bast->invoice->client->nama_client}}
                        dengan kondisi baik.&nbsp; </div>
                    <div align="center" class="style9">
                        <div align="center" class="style9"> </div>
                    </div>
                    <div align="center" class="style9"></div>
                    <div align="center" class="style9">
                        <div align="center" class="style9"></div>
                    </div>
                    <div align="center" class="style9">
                        <div align="left" class="style9b"></div>
                    </div>
                </td>
            </tr>


            <tr>
                <td width="25" class="style9">
                    <div align="right">2.</div>
                </td>
                <td colspan="10" class="style9">
                    <div align="justify">{{$bast->invoice->client->nama_client}} telah menerima pekerjaan beserta titelnya dari
                        mitra/rekanan, dengan Ketentuan sebagai berikut :&nbsp; </div>
                    <div align="center" class="style9">
                        <div align="center" class="style9"> </div>
                    </div>
                    <div align="center" class="style9"></div>
                    <div align="center" class="style9">
                        <div align="center" class="style9"></div>
                    </div>
                    <div align="center" class="style9">
                        <div align="left" class="style9b"></div>
                    </div>
                </td>
            </tr>

            <tr>
                <td width="25" class="style9b">
                    <div align="justify"></div>
                </td>
                <td width="29" class="style9b">
                    <div align="right"><span class="style9">a.</span></div>
                </td>
                <td colspan="9" class="style9b">
                    <div align="justify"><span class="style9">Pekerjaan diterima dengan baik.</span> </div>
                    <div align="center" class="style9">
                        <div align="justify"><b>
                            </b>
                        </div>
                        <div align="center" class="style9"> </div>
                        <div align="justify"><b></b><b> </b> </div>
                    </div>
                    <div align="center" class="style9"></div>
                    <div align="center" class="style9">
                        <div align="center" class="style9"></div>
                    </div>
                    <div align="center" class="style9">
                        <div align="left" class="style9b"></div>
                    </div>
                </td>
            </tr>

            <tr>
                <td width="25" class="style9b">
                    <div align="justify"></div>
                </td>
                <td width="29" class="style9b">
                    <div align="right"><span class="style9">b.</span></div>
                </td>
                <td colspan="9" class="style9b">
                    <div align="justify"><span class="style9">Jumlah pembayaran yang dikenakan atas perkerjaan
                            tersebut diatas adalah seharga    Rp. {{ number_format(floor($jumlahHarga), 0, ',', '.') }},-</span>
                    </div>
                    <div align="center" class="style9">
                        <div align="justify"><b>
                            </b>
                        </div>
                        <div align="center" class="style9"> </div>
                        <div align="justify"><b></b><b> </b></div>
                    </div>
                    <div align="center" class="style9"></div>
                    <div align="center" class="style9">
                        <div align="center" class="style9"></div>
                    </div>
                    <div align="center" class="style9">
                        <div align="left" class="style9b"></div>
                    </div>
                </td>
            </tr>



            <tr>
                <td colspan="9">&nbsp;</td>
                <td width="186">&nbsp;</td>
                <td width="508">&nbsp;</td>
            </tr>



            <tr>
                <td colspan="9">&nbsp;</td>
                <td width="186">&nbsp;</td>
                <td width="508">&nbsp;</td>
            </tr>

            <tr>
                <td colspan="9">&nbsp;</td>
                <td width="186">&nbsp;</td>
                <td width="508">&nbsp;</td>
            </tr>

            <tr>
                <td colspan="9">&nbsp;</td>
                <td width="186">&nbsp;</td>
                <td width="508">&nbsp;</td>
            </tr>



        </tbody>
    </table>

    <table width="82%" align="center">

        <tbody>
            <tr>
                <td colspan="3">
                    <div align="left" class="style9">
                        <div align="justify"></div>
                    </div>
                </td>
            </tr>

            <tr>
                <td colspan="3">
                    <div align="left" class="style9">
                        <div align="justify"></div>
                    </div>
                </td>
            </tr>

            <tr>
                <td colspan="3">
                    <div align="left" class="style9">
                        <div align="justify"></div>
                    </div>
                </td>
            </tr>

            <tr>
                <td colspan="3">
                    <div align="left" class="style9">
                        <div align="justify"></div>
                    </div>
                </td>
            </tr>

            <tr>
                <td colspan="3">
                    <div align="left" class="style9">
                        <div align="justify"></div>
                    </div>
                </td>
            </tr>

            <tr>
                <td colspan="3">
                    <div align="left" class="style9">
                        <div align="justify"></div>
                    </div>
                </td>
            </tr>

            <tr>
                <td colspan="3">
                    <div align="left" class="style9">
                        <div align="justify"></div>
                    </div>
                </td>
            </tr>

            <tr>
                <td colspan="3">
                    <div align="left" class="style9">
                        <div align="justify"></div>
                    </div>
                </td>
            </tr>

            <tr>
                <td colspan="3">
                    <div align="left" class="style9">
                        <div align="justify"></div>
                    </div>
                </td>
            </tr>

            <tr>
                <td colspan="3">
                    <div align="left" class="style9">
                        <div align="justify"></div>
                    </div>
                </td>
            </tr>

            <tr>
                <td colspan="3">
                    <div align="left" class="style9">
                        <div align="justify"></div>
                    </div>
                </td>
            </tr>

            <tr>
                <td colspan="3">
                    <div align="left" class="style9">
                        <div align="justify"></div>
                    </div>
                </td>
            </tr>

            <tr>
                <td colspan="3">
                    <div align="left" class="style9">
                        <div align="justify"></div>
                    </div>
                </td>
            </tr>

            <tr>
                <td colspan="3">
                    <div align="left" class="style9">
                        <div align="justify"></div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <div align="left" class="style9">
                        <div align="justify"></div>
                    </div>
                </td>
            </tr>

            <tr>
                <td colspan="3">
                    <div align="left" class="style9">
                        <div align="justify"></div>
                    </div>
                </td>
            </tr>

            <tr>
                <td colspan="3">
                    <div align="left" class="style9">
                        <div align="justify"></div>
                    </div>
                </td>
            </tr>

            <tr>
                <td colspan="3">
                    <div align="left" class="style9">
                        <div align="justify"></div>
                    </div>
                </td>
            </tr>

            <tr>
                <td colspan="3">
                    <div align="left" class="style9">
                        <div align="justify"></div>
                    </div>
                </td>
            </tr>

            <tr>
                <td colspan="3">
                    <div align="left" class="style9">
                        <div align="justify"></div>
                    </div>
                </td>
            </tr>

            <tr>
                <td colspan="3">
                    <div align="left" class="style9">
                        <div align="justify"></div>
                    </div>
                </td>
            </tr>

            <tr>
                <td colspan="3">
                    <div align="left" class="style9">
                        <div align="justify"></div>
                    </div>
                </td>
            </tr>

            <tr>
                <td colspan="3">
                    <div align="left" class="style9">
                        <div align="justify"></div>
                    </div>
                </td>
            </tr>

            <tr>
                <td colspan="3">
                    <div align="left" class="style9">
                        <div align="justify"></div>
                    </div>
                </td>
            </tr>

            <tr>
                <td colspan="3">
                    <div align="left" class="style9">
                        <div align="justify"></div>
                    </div>
                </td>
            </tr>


            <tr>
                <td width="383">&nbsp;</td>
                <td width="178">&nbsp;</td>
                <td width="393">&nbsp;</td>
            </tr>


            <tr>
                <td width="383">&nbsp;</td>
                <td width="178">&nbsp;</td>
                <td width="393">&nbsp;</td>
            </tr>


            <tr>
                <td width="383">&nbsp;</td>
                <td width="178">&nbsp;</td>
                <td width="393">&nbsp;</td>
            </tr>


            <tr>
                <td width="383">&nbsp;</td>
                <td width="178">&nbsp;</td>
                <td width="393">&nbsp;</td>
            </tr>


            <tr>
                <td colspan="3">
                    <div align="left" class="style9">
                        <div align="justify">Berita Acara ini rangkap 2 (dua) asli yang masing-masing mempunyai
                            kekuatan hukum yang sama setelah di tandatangani oleh wakil sah masing-masing pihak.</div>
                    </div>
                </td>
            </tr>
            <tr>
                <td width="383">&nbsp;</td>
                <td width="178">&nbsp;</td>
                <td width="393">&nbsp;</td>
            </tr>

            <tr>
                <td>&nbsp;</td>
                <td width="178">&nbsp;</td>
                <td width="393">&nbsp;</td>
            </tr>


            <tr>
                <td width="383">&nbsp;</td>
                <td width="178">&nbsp;</td>
                <td width="393">&nbsp;</td>
            </tr>

            <tr>
                <td>&nbsp;</td>
                <td width="178">&nbsp;</td>
                <td width="393">&nbsp;</td>
            </tr>

            <tr>
                <td>&nbsp;</td>
                <td width="178">&nbsp;</td>
                <td width="393">&nbsp;</td>
            </tr>

            <tr>
                <td>&nbsp;</td>
                <td width="178">&nbsp;</td>
                <td width="393">&nbsp;</td>
            </tr>

            <tr>
                <td class="style9b">
                    <div align="left"><b>PT. Multi Power Abadi</b></div>
                </td>
                <td width="178">&nbsp;</td>
                <td width="393">
                    <div align="left"><b class="style9b"><b><span class="style9"><b>{{$bast->invoice->client->nama_client}}
                                    </b></span></b></b></div>
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td width="178">&nbsp;</td>
                <td width="393">&nbsp;</td>
            </tr>

            <tr>
                <td>&nbsp;</td>
                <td width="178">&nbsp;</td>
                <td width="393">&nbsp;</td>
            </tr>

            <tr>
                <td>&nbsp;</td>
                <td width="178">&nbsp;</td>
                <td width="393">&nbsp;</td>
            </tr>

            <tr>
                <td>&nbsp;</td>
                <td width="178">&nbsp;</td>
                <td width="393">&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td width="178">&nbsp;</td>
                <td width="393">&nbsp;</td>
            </tr>

            <tr>
                <td>&nbsp;</td>
                <td width="178">&nbsp;</td>
                <td width="393">&nbsp;</td>
            </tr>



            <tr>
                <td>
                    <div align="left"><u class="style9b"><b>Nama&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: Mariyadi</b></u>
                    </div>
                </td>
                <td width="178">&nbsp;</td>
                <td width="393">
                    <div align="left"><b class="style9b"><u>Nama&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{$bast->nama}}</u></b></div>
                </td>
            </tr>
            <tr>
                <td>
                    <div align="left"><span class="style9">Jabatan&nbsp;&nbsp;: Direktur</span></div>
                </td>
                <td width="178">&nbsp;</td>
                <td width="393">
                    <div align="left"><span class="style9">Jabatan &nbsp;: {{$bast->jabatan}}</span></div>
                </td>
            </tr>



        </tbody>
    </table>

    <div class="cetak no-print"><a href="" onclick="print();"><b>(Cetak)</b></a>
    </div>
</body>

</html>
