<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kartu</title>

    <style>
        @media print and (color) {

            @page {
                size: 8.6cm 5.45cm;
                size: potrait;
                margin: 0;
            }

            * {
                font-family: 'arial';
            }

            body {
                max-width: 8.56cm;
                max-height: 5.39cm;
                margin: 0;
                padding: 0;
            }

            .card {
                position: relative;
                width: 8.56cm;
                height: 5.39cm;
                background-color: white;
                /* border-radius: 1rem; */
                /* border: 1px solid black; */
            }

            .bg-head {
                position: absolute;
                height: 3.2cm;
                width: inherit;
                background-color: #CE161E !important;
                -webkit-print-color-adjust: exact;
                /* border-top-left-radius: 1rem; */
                /* border-top-right-radius: 1rem; */
                z-index: 1;
                display: flex;
                flex-direction: row;
                justify-content: space-between;
            }

            .bg-head .card-title {
                padding-left: 1rem;
                color: white;
            }

            .content {
                position: relative;
                display: flex;
                flex-direction: column;
                z-index: 10;
                text-align: end;
                padding: 4rem 2rem 0rem 0rem;
            }

            .content .txt-number {
                margin: 0;
                font-weight: lighter;
                color: white !important;
                -webkit-print-color-adjust: exact;
            }

            .content .txt-name {
                margin: 0;
                font-weight: lighter;
                color: white !important;
                -webkit-print-color-adjust: exact;
            }
        }

        * {
            font-family: 'arial';
        }

        body {
            max-width: 8.56cm;
            max-height: 5.39cm;
            margin: 0;
            padding: 0;
        }

        .card {
            position: relative;
            width: 8.56cm;
            height: 5.39cm;
            background-color: white;
            /* border-radius: 1rem; */
            border: 1px solid black;
        }

        .bg-head {
            position: absolute;
            height: 3.2cm;
            width: inherit;
            background-color: #CE161E !important;
            /* border-top-left-radius: 1rem; */
            /* border-top-right-radius: 1rem; */
            z-index: 1;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
        }

        .bg-head .logo-gresik {
            width: 3.5rem;
            height: 3.5rem;
            padding-right: 1.5rem;
        }

        .bg-head .card-title {
            padding-left: 1rem;
            padding-top: 1rem;
            margin: 0;
            font-size: 1.2rem;
            color: white;
        }

        .content {
            position: relative;
            display: flex;
            flex-direction: column;
            z-index: 10;
            text-align: end;
            padding: 4rem 2rem 0 0;
        }

        .content .txt-number {
            margin: 0;
            font-weight: lighter;
            color: white;
        }

        .content .txt-name {
            margin: 0;
            font-weight: lighter;
            color: white;
        }

        .content .barcode {
            margin-top: 1.5rem;
        }

        .card-icon {
            position: absolute;
            height: 7rem;
            bottom: 0;
            z-index: 12;
        }

        .bg-yellow {
            background-color: #ffdc5c !important;
            -webkit-print-color-adjust: exact;
        }

        .card .header {
            display: flex;
            flex-direction: row;
            padding: .5rem;
            align-items: flex-end;
        }

        .card1-title {
            margin: 0;
            padding: .5rem;
        }

        .card .box-grey {
            background-color: #585454;
            height: 2rem;
        }

        .content1 {
            display: flex;
            flex-direction: row;
            justify-content: flex-end;
        }

        .content1 .box {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 1rem;
        }

        .box .box-white {
            height: 1.5rem;
            width: 10rem;
            background-color: white;
        }

        .box .box-text {
            margin-top: .5rem;
            font-size: .7rem;
        }

        .card .img-bupati {
            position: absolute;
            bottom: 0;
            width: 12rem;
            /* height: 1rem; */
        }
    </style>
</head>
<body>
<div class="card bg-yellow">
    <div class="header">
        <img style="width: 2rem; height: 2rem;" src="{{ asset('app-assets/img/illustrations/logo-gresik.png') }}"
             alt="">
        <h6 class="card1-title">Kartu Go Tani-Perikanan</h6>
    </div>
    <div class="box-grey"></div>
    <div class="content1">
        <div class="box">
            <div class="box-white"></div>
            <p class="box-text">Program Prioritas Nawakarsa</p>
        </div>
    </div>
    <img class="img-bupati" src="{{ asset('app-assets/img/illustrations/bupati-nama.png') }}" alt="">
</div>
<div class="card">
    <div class="bg-head">
        <h5 class="card-title">Kartu Go Tani-Perikanan</h5>
        <img class="logo-gresik" src="{{ asset('app-assets/img/illustrations/logo-gresik.png') }}" alt="">
    </div>
    <img class="card-icon" src="{{ asset('app-assets/img/illustrations/nelayan.png') }}" alt="">
    <div class="content">
        <h2 class="txt-number">{{ $data->national_identity_number }}</h2>
        <h4 class="txt-name">{{ $data->name }}</h4>
        <span class="barcode">{{ QrCode::size(48)->generate($data->national_identity_number) }}</span>
    </div>
</div>
</body>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        window.print()
    })
</script>
</html>
