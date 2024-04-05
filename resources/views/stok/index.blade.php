@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools">
                <a class="btn btn-sm btn-primary mt-1" href="{{ url('stok/create') }}">Tambah</a>
            </div>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif


            <div class="row">
                <div class="col-ms-6">
                    <div class="form-group row">
                        <label class="col-4 control-label col-form-label">Filter User :</label>
                        <div class="col-8">
                            <select name="user_id" id="user_id" class="form-control" required>
                                <option value="">- Semua -</option>
                                @foreach ($user as $item)
                                    <option value="{{ $item->user_id }}">{{ $item->user_nama }}</option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">Level Pengguna</small>
                        </div>
                    </div>
                </div>
                <div class="col-ms-6">
                    <div class="form-group row">
                        <label class="col-4 control-label col-form-label">Filter Barang :</label>
                        <div class="col-8">
                            <select name="barang_id" id="barang_id" class="form-control" required>
                                <option value="">- Semua -</option>
                                @foreach ($barang as $item)
                                    <option value="{{ $item->barang_id }}">{{ $item->barang_nama }}</option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">Nama Barang</small>
                        </div>
                    </div>
                </div>
            </div>


            <table class="table table-bordered table-striped table-hover table-sm" id="table_stok">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama User</th>
                        <th>Nama Barang</th>
                        <th>Tanggal</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@push('css')
@endpush
@push('js')
    <script>
        $(document).ready(function() {
            var dataStok = $('#table_stok').DataTable({
                serverSide: true,
                ajax: {
                    "url": "{{ url('stok/list') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": function(d) {
                        d.user_id = $('#user_id').val();
                        d.barang_id = $('#barang_id').val();
                    }
                },
                columns: [{
                    data: "DT_RowIndex",
                    className: "text-center",
                    orderable: false,
                    searchable: false
                }, {
                    data: "user.username",
                    className: "",
                    orderable: true,
                    searchable: true
                }, {
                    data: "barang.barang_nama",
                    className: "",
                    orderable: true,
                    searchable: true
                },{
                    data: "stok_tanggal",
                    className: "",
                    orderable: true,
                    searchable: true
                }, {
                    data: "stok_jumlah",
                    className: "",
                    orderable: true,
                    searchable: true
                },{
                    data: "aksi",
                    className: "",
                    orderable: false,
                    searchable: false
                }]
            });
            $('#user_id, #barang_id').on('change', function() {
                dataStok.ajax.reload();
            });
        });
    </script>
@endpush