@php use App\Helpers\UserHelper; @endphp
@extends('dashboard.layouts.main')
@section('content')
    @php
        $ketua = UserHelper::checkRoleKetuaKelompok();
            $kepalaDinas = UserHelper::checkRoleKepalaDinas();
            $tangkap = UserHelper::checkRoleTangkap();
            $pembudidaya = UserHelper::checkRolePembudidaya();
            $penyuluh = UserHelper::checkRolePenyuluh();
    @endphp
    <div class="container-fluid p-0">
        <div class="row mb-2 mb-xl-3">
            <div class="col-auto d-none d-sm-block">
                <h3>Selamat Datang, {{ auth()->user()->name }}</h3>
            </div>
        </div>

        <div class="row">
            @if($ketua)
                <x-summaries.ketua :data="$data"></x-summaries.ketua>
            @endif
            @if($penyuluh)
                <x-summaries.penyuluh :data="$data"></x-summaries.penyuluh>
            @endif
            @if($kepalaDinas)
                <x-summaries.dinas :data="$data"></x-summaries.dinas>
            @endif
            @if($tangkap || $pembudidaya)
                <x-summaries.admin :data="$data"></x-summaries.admin>
            @endif
        </div>

    </div>
@endsection
