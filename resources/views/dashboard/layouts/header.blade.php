<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="Dashboard">
<meta name="author" content="Yudas Malabi">
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ config('app.name') . ' | ' . explode('.', request()->route()->getName())[0] }}</title>

<link rel="shortcut icon" href="{{ asset('app-assets/img/favicon.ico') }}">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&amp;display=swap" rel="stylesheet">

<link class="js-stylesheet" href="{{ asset('app-assets/css/light.css') }}" rel="stylesheet">
