<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Recommendation Letter</title>

    <link rel="stylesheet" href="{{ asset('app-assets/css/surat.css')  }}">

</head>
<body onload="window.print()">
<div class="container page">
    <div class="row align-items-center">
        <div class="col-2 text-end">
            <img src="{{ asset('app-assets/img/brands/logo-gresik.png') }}" height="132" alt="logo-gresik">
        </div>
        <div class="col-10 text-center header-letter">
            <h5 class="fw-bold" style="font-size: 14pt">PEMERINTAH KABUPATEN GRESIK</h5>
            <h5 class="fw-bold" style="font-size: 14pt">DINAS PERIKANAN</h5>
            <p style="font-size: 10pt">Jl. Dr. Wahidin Sudirohusodo No. 44 A Telp./Fax. (031) 3984523</p>
            <h5 style="font-size: 14pt"><span class="fw-bold">GRESIK</span> 61121</h5>
        </div>
    </div>
    <hr>
    <div class="row" style="margin-top: 1rem">
        <div class="text-center no-surat">
            <h6 class="fw-bold text-decoration-underline" style="font-size: 11pt; margin: 0">SURAT REKOMENDASI PEMBELIAN JENIS BBM TERTENTU (JENIS MINYAK SOLAR)</h6>
            <p style="margin: 0"><span class="fw-bold">Nomor : </span>523/{{ \Carbon\Carbon::parse($submission->created_at)->timestamp }}/437.60/{{ date('Y') }}</p>
        </div>
    </div>
    <div class="row px-5 mt-3 fw-bold rules" style="margin-top: 1rem">
        <table>
            <tr>
                <td width="15%" class="fw-bold" style="vertical-align: top">Dasar : </td>
                <td>
                    <ol start="1">
                        <li class="fw-bold">Undang – undang Nomor 22 Tahun 2001 tentang Minyak dan Gas Bumi.</li>
                        <li class="fw-bold">Undang-undang Nomor 23 tahun Pemerintah Daerah.</li>
                        <li class="fw-bold">Peraturan  Presiden Nomor 191 Tahun 2014 tentang penyediaan, Pendistribusian dan Harga Jual Eceran Bahan Bakar Minyak sebagaimana telah diubah dengan Peraturan Presiden Nomor 43 Tahun 2018 tentang Perubahan  atas Peraturan Presiden Nomor 191 Tahun 2014 tentang penyediaan Pendistribusian dan Harga Jual Eceran Bahan Bakar Minyak.</li>
                        <li class="fw-bold">Nomor Induk Berusaha : 1010220017865  Tanggal 10 Oktober 2022.</li>
                    </ol>
                </td>
            </tr>
        </table>
    </div>
    <div class="row" style="margin-top: 1rem">
        <div class="col-12" style="font-size: 11pt">
            <p>Dengan ini memberikan Rekomendasi Kepada</p>
            <table width="100%">

                <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td>{{ $submission->user->name  }} ( {{ $submission->group->group_name }} )</td>
                </tr>
                <tr>
                    <td>No. Identitas diri (KTP/SIM)</td>
                    <td>:</td>
                    <td>{{ $submission->user->national_identity_number  }}</td>
                </tr>
                <tr>
                    <td style="text-align: start; vertical-align: top">Alamat Usaha</td>
                    <td style="text-align: start; vertical-align: top">:</td>
                    <td style="text-align: start">{{ $submission->user->address  }}
                    </td>
                </tr>
                <tr>
                    <td>Konsumen Pengguna</td>
                    <td>:</td>
                    <td>Perikanan</td>
                </tr>
                <tr>
                    <td>Jenis Usaha Kegiatan</td>
                    <td>:</td>
                    <td>
                        @if($submission->receiver_type == "Nelayan")
                            Perikanan  Tangkap
                        @else
                            Pembudidaya
                        @endif
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="row" style="font-size: 11pt; margin-top: 1rem">
        <ol start="1">
            <li>Bedasarkan hasil berifikasi, Kebutuhan BBM digunakan untuk sarana sebagai berikut :
            <table class="table table-bordered text-center" style="vertical-align: middle">
                <tr>
                    <th style="vertical-align: inherit">No</th>
                    <th style="vertical-align: inherit">Jenis Alat</th>
                    <th style="vertical-align: inherit">Jumlah Alat / Ukuran Mesin</th>
                    <th style="vertical-align: inherit">Fungsi Alat</th>
                    <th style="vertical-align: inherit">Kebutuhan Jenis BBM Tertentu</th>
                    <th style="vertical-align: inherit">Jam atau hari Operasi</th>
                    <th style="vertical-align: inherit">Konsumsi Jenis BBM Tertentu Liter</th>
                </tr>
                <tr>
                    <td>1.</td>
                    <td>Mesin Diesel</td>
                    <td>{{ $submission->submission_receivers->count() }} PK & {{ $submission->submission_receivers->count() }} PK</td>
                    <td>
                        @if($submission->receiver_type == "Nelayan")
                            Transportasi Menangkap Ikan
                        @else
                            Membudidaya Ikan
                        @endif
                    </td>
                    <td>SOLAR</td>
                    <td>30 Hari</td>
                    <td>{{ $submission->submission_receivers->sum('quota') }} Liter</td>
                </tr>
            </table>
            </li>
            <li>Diberikan jenis BBM Tententu Jenis Minyak :
            <ul style="margin-left: 1rem">
                <li>Alokasi Volume: {{ $submission->submission_receivers->sum('quota') }} Liter</li>
                <li>Tempat pengambilan		: Lembaga Penyalur ({{ $submission->station->type }})</li>
                <li>Nomor Lembaga Penyalur	: No. SPBU {{ $submission->station->number }}</li>
                <li>Lokasi				: {{ $submission->station->address }}</li>
            </ul>
            </li>
            <li>Masa berlaku Surat Rekomendasi sampai dengan tangga.l : <span class="fw-bold">{{ date('d F Y', strtotime($submission->start_time)) }} s/d {{ date('d F Y', strtotime($submission->end_time)) }}.</span></li>
            <li>Apabila penggunana Surat Rekomendasi ini tidak sebagaimana mestinya, maka akan dicabut dan di ditindaklanjuti dengan proses hukum sesui dengan ketentuan peraturan perundang-undangan.</li>
        </ol>
    </div>
    <div class="row footer-container">
        <div class="footer-left" style="font-size: 10pt">
            <p class="fw-bold text-decoration-underline">Catatan</p>
            <p style="line-height: 1rem">Harap tidak dilayani jika dalam pembelian  BBM bersubsidi nama yang tertera dalam identitas diri pembeli BBM tidak sama ataupun masa berlaku Surat Rekomendasi sudah habis.</p>
            <p class="fw-bold mt-3">-       {{ $submission->station->name }}</p>
        </div>
        <div class="text-center footer-right" style="margin: 0;font-size: 11pt">
            <p>Gresik, {{ date('d F Y', strtotime(now())) }}</p>
            <p>KEPALA UNIT PELAKSANA TEKNIS</p>
            <p>TEMPAT PELELANGAN IKAN CAMPUREJO</p>
            <br><br><br><br><br>
            <p class="fw-bold text-decoration-underline">WIWIK TRIWIJIASTUTI, S,Pi</p>
            <p>Penata Tk I</p>
            <p>NIP. 19660424 199103  2 011</p>
        </div>
    </div>
</div>
</body>
</html>
