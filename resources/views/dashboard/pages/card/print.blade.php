<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kartu</title>

    <style>
        @media print and (color) {

            @page
            {
                size: 8.6cm 5.45cm;
                size: potrait;
                margin: 0;
            }

            *{
                font-family: 'arial';
            }
    
            body{
                max-width: 8.56cm;
                max-height: 5.39cm;
                margin: 0;
                padding: 0;
            }
    
            .card{
                position: relative;
                width: 8.56cm;
                height: 5.39cm;
                background-color: white;
                border-radius: 1rem;
                border: 1px solid black;
            }
    
            .bg-head{
                position: absolute; 
                height: 1.5cm;
                width: inherit;
                background-color: #CE161E !important;
                -webkit-print-color-adjust: exact; 
                border-top-left-radius: 1rem;
                border-top-right-radius: 1rem;
                z-index: 1;
                display: flex;
                flex-direction: row;
                justify-content: space-between;
            }
    
            .bg-head .card-title{
                padding-left: 1rem;
                color: white;
            }
    
            .content{
                position: relative;
                display: flex;
                flex-direction: column;
                z-index: 10;
                text-align: end;
                padding: 4rem 2rem 0rem 0rem;
            }
    
            .content .txt-number{
                margin: 0;
            }
    
            .content .txt-name{
                margin: 0;
            }
    
            .content .barcode{
                margin-top: 1rem;
                margin-right: 3rem;
            }
    
            .card-icon{
                position: absolute;
                height: 10rem;
                bottom: 0;
                z-index: 12;
            }
        }
            *{
                font-family: 'arial';
            }
    
            body{
                max-width: 8.56cm;
                max-height: 5.39cm;
                margin: 0;
                padding: 0;
            }
    
            .card{
                position: relative;
                width: 8.56cm;
                height: 5.39cm;
                background-color: white;
                border-radius: 1rem;
                border: 1px solid black;
            }
    
            .bg-head{
                position: absolute; 
                height: 1.5cm;
                width: inherit;
                background-color: #CE161E !important;
                border-top-left-radius: 1rem;
                border-top-right-radius: 1rem;
                z-index: 1;
                display: flex;
                flex-direction: row;
                justify-content: space-between;
            }

            .bg-head .logo-gresik{
                width: 3.5rem;
            }
    
            .bg-head .card-title{
                padding-left: 1rem;
                color: white;
            }
    
            .content{
                position: relative;
                display: flex;
                flex-direction: column;
                z-index: 10;
                text-align: end;
                padding: 4rem 2rem 0 0;
            }
    
            .content .txt-number{
                margin: 0;
            }
    
            .content .txt-name{
                margin: 0;
            }
    
            .content .barcode{
                margin-top: 1rem;
                margin-right: 3rem;
            }
    
            .card-icon{
                position: absolute;
                height: 10rem;
                bottom: 0;
                z-index: 12;
            }
    </style>
</head>
<body onload="window.print()">
    <div class="card">
        <div class="bg-head">
            <h5 class="card-title">Kartu Go Tani-Perikanan</h5>
            <img class="logo-gresik" src="{{ asset('app-assets/img/illustrations/logo-gresik.png') }}" alt="">
        </div>
        <img class="card-icon" src="{{ asset('app-assets/img/illustrations/card-icon.png') }}" alt="">
        <div class="content">
            <h2 class="txt-number">{{ $data->national_identity_number }}</h2>
            <h4 class="txt-name">{{ $data->name }}</h4>
            <span class="barcode">{{ QrCode::size(48)->generate($data->national_identity_number) }}</span>
        </div>
    </div>
</body>
</html>