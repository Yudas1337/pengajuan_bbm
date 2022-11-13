<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recommendation Letter</title>

    <style>
        @media print {
            .break-page {page-break-after: always;}
        }

        *{
            margin: 0;
            padding: 0;
            font-family: Arial, Helvetica, sans-serif;
        }
        .container{
            padding: 2rem 5rem;
        }

        .header{
            display: flex;
            flex-direction: row;
        }

        .header .logo{
            width: 5rem;
            flex: 1;
        }

        .header .header-body{
            flex: 10;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .txt-small{
            font-size: 10pt;
        }

        .first-hr{
            margin-top: .5rem;
            margin-bottom: .2rem;
        }

        .title-letter{
            display: flex;
            flex-direction: row;
        }

        .description{
            margin-top: 1rem;
            line-height: 1.5rem;
        }

        .description p {
            margin-top: .5rem;
        }

        ol,ul{
            padding-left: 1rem;
        }

        .ttd-container{
            margin-top: 5rem;
            display: flex;
            flex-direction: row;
            justify-content: flex-end;
        }

        .ttd{
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .txt-name{
            font-weight: bold;
            text-decoration: underline;
        }

        .tembusan-container{
            margin-top: 3rem;
        }

        .title{
            margin-top: 2rem;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .title .title-letter{
            font-weight: bold;
            text-decoration: underline;
        }
    </style>
</head>
<body onload="window.print()">
    <div class="container">
        <div class="header">
            <img class="logo" src="{{ asset('app-assets/img/illustrations/logo-black.png') }}" alt="">
            <div class="header-body">
                <h3>PEMERINTAH KABUPATEN GRESIK</h3>
                <h3>DINAS PERIKANAN</h3>
                <p class="txt-small">JL. Dr. Wahidin Sudirohusodo No. 44 A Telp. / Fax. (031) 3984523</p>
                <p class="txt-small">GRESIK - 61121</p>
            </div>
        </div>
        <hr class="first-hr" size="1" color="black"><hr size="1" color="black">
        <div class="description">
            <ol type="1" start="2">
                <li>Diberikan Jenis BBM Tertentu Jenis Minyak Solar ( Gas Oil )
                    <ul>
                        <li>Alokasi volume                  : Solar 3.840 liter per (jam/hari/minggu/bulan)</li>
                        <li>Tempat Pengambilan              : Lembaga Penyalur (SPBU/APMS/SPDN/SPBN)</li>
                        <li>Nomor Lembaga Penyalur          : <b>54.611.30</b></li>
                        <li>Lokasi                          : <b>Desa Prambangan Kecamatan Kebomas</b></li>
                    </ul>
                </li>
                <li>Masa berlaku surat rekomendasi sampai dengan : <b>17 Agustus 2022</b></li>
                <li>Apabila pengguna rekomendasi ini tidak sebagaimana mestinya maka akan dicabut dan ditindaklanjuti dengan proses hukum sesuai dengan ketentuan dan peraturan perundang-undangan</li>
            </ol>
        </div>
        <div class="ttd-container">
            <div class="ttd">
                <p class="txt-small">Gresik, 18 Juli 2022</p>
                <br>
                <p class="txt-small">Plt. KEPALA DINAS PERIKANAN</p>
                <p class="txt-small">KABUPATEN GRESIK</p>
                <br><br><br>
                <p class="txt-small txt-name">Ir. EKO ANINDITO PUTRO, M.M.A</p>
                <p class="txt-small">Pemibina Utama Muda</p>
                <p class="txt-small">NIP. 19660914 199202 1 002</p>
            </div>
        </div>
        <div class="tembusan-container">
            <p class="txt-small">Tembusan disampaikan kepada : </p>
            <ol>
                <li class="txt-small">Polsek Kebomas di Kebomas</li>
                <li class="txt-small">Pimpinan SPBU <b>54.611.30</b>
                <br>Desa Prambangan Kecamatan Kebomas
                </li>
            </ol>
        </div>
    </div>
    <div class="break-page"></div>
    <div class="container">
        <div class="header">
            <img class="logo" src="{{ asset('app-assets/img/illustrations/logo-black.png') }}" alt="">
            <div class="header-body">
                <h3>PEMERINTAH KABUPATEN GRESIK</h3>
                <h3>DINAS PERIKANAN</h3>
                <p class="txt-small">JL. Dr. Wahidin Sudirohusodo No. 44 A Telp. / Fax. (031) 3984523</p>
                <p class="txt-small">GRESIK - 61121</p>
            </div>
        </div>
        <hr class="first-hr" size="1" color="black"><hr size="1" color="black">
        <div class="title">
            <p class="txt-small title-letter">SURAT REKOMENDASI PEMBELIAN BBM JENIS TERTENTU</p>
            <p class="txt-small">Nomor : 541/     /437.60/2022</p>
        </div>

        <div class="description">
            <p>Dasar Hukum      :</p>
            <ol>
                <li>Undang-Undang Nomor 22 Tahun 2001 tentang Minyak dan Gas Bumi;</li>
                <li>Undang-Undang Nomor 23 Tahun 2014 tentang Pemerintahan Daerah;</li>
                <li>Peraturan Presiden nomor 191 Tahun 2014 tentang Penyediaan, Pendistribusian dan Harga Jual Eceran Bahan Bakar Minyak sebagaimana diubah dengan Peraturan Presiden nomor 43 Tahun 2018 tentang Perubahan atas Peraturan Presiden nomor 191 Tahun 2014 tentang Penyediaan, Pendistribusian dan Harga Jual Eceran Bahan Bakar Minyak; </li>
                <li>Peraturan Badan Pengatur Hilir Minyak dan Gas Bumi Nomor 17 Tahun 2019 Tentang Penerbitan Surat Rekomendasi Perangkat Daerah untuk Pembelian Jenis Bahan Bakar Minyak Tertentu; dan</li>
                <li>Permohonan Rekomendasi Pembelian BBM oleh Kelompok Nelayan " <b>RUKUN JAYA</b> " Desa Sukorejo Kecamatan Kebomas Kabupaten Gresik Nomor : 299/437.102.10/2022 tanggal 14 Juni 2022</li>
            </ol>
            <p>Dengan ini memberikan rekomendasi kepada : </p>
            <table>
                <tr>
                    <td>Nama</td>
                    <td>: <b>M.KHOTIB</b></td>
                </tr>
                <tr>
                    <td></td>
                    <td>( Ketua Kelompok Nelayan <b>" RUKUN JAYA "</b>)</td>
                </tr>
                <tr>
                    <td>Alamat Usaha</td>
                    <td>: Desa Sukorejo Kecamatan Kebomas Kabupaten Gresik</td>
                </tr>
                <tr>
                    <td>Konsumen Pengguna</td>
                    <td>: Usaha Mikro/Pertanian/Perikanan/Transportasi/Pelayanan Umum *)</td>
                </tr>
                <tr>
                    <td>Jenis usaha/kegiatan</td>
                    <td>: Penangkapan Ikan</td>
                </tr>
            </table>
            <br>
            <ol>
                <li>Berdasarkan hasil verifikasi kebutuhan BBM digunakan untuk sarana sebagai berikut : </li>
            </ol>
            <br>
            <table border="1" style="  border-collapse: collapse;">
                <thead>
                    <th>No</th>
                    <th>Jenis Alat</th>
                    <th>Jumlah Alat</th>
                    <th>Fungsi Alat</th>
                    <th>BBM jenis tertentu</th>
                    <th>Kebutuhan BBM jenis tertentu</th>
                    <th>Jam atau hari operasi</th>
                    <th>Konsumsi BBM Jenis tertentu liter per(jam/hari/minggu/bulan)</th>
                </thead>
                <tbody>
                    <tr>
                        <td>1.</td>
                        <td>Perahu Bermotor Diesel</td>
                        <td>33 Unit</td>
                        <td>Transportasi Pencari Ikan</td>
                        <td>Solar</td>
                        <td>20 liter / hari</td>
                        <td>20 Jam / hari</td>
                        <td>660 liter / hari</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>