@extends('layout.app')

@section('subtitle', 'Kategori')
@section('content_header_title', 'Kategori')
@section('content_header_subtitle', 'Create')

@section('content')
    <div class="container">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Buat Kategori Baru</h3>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('kategori.store') }}">
                    {{ @csrf_field() }}
                    <div class="form-group">
                        <label for="kategori_kode">Kode Kategori</label>
                        <input id="kategori_kode" type="text"
                            class="@error('kategori_kode') is-invalid @enderror form-control" name="kategori_kode"
                            placeholder="Masukkan Kode Kategori">

                        @error('kategori_kode')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror