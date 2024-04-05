@extends('m_user/template')
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2 class="mb-0 text-primary">CRUD User</h2>
                    <a class="btn btn-success" href="{{ route('m_user.create') }}">Input User</a>
                </div>
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Daftar User</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr class="bg-secondary text-white">
                                    <th class="text-center">User ID</th>
                                    <th class="text-center">Level Nama</th>
                                    <th class="text-center">Username</th>
                                    <th class="text-center">Nama</th>
                                    <th class="text-center">Password</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($useri as $m_user)
                                    <tr>
                                        <td class="text-center">{{ $m_user->user_id }}</td>
                                        <td class="text-center">{{ $m_user->level->level_nama }}</td>
                                        <td class="text-center">{{ $m_user->username }}</td>
                                        <td class="text-center">{{ $m_user->nama }}</td>
                                        <td class="text-center">{{ $m_user->password }}</td>
                                        <td class="text-center">
                                            <form action="{{ route('m_user.destroy', $m_user->user_id) }}" method="POST">
                                                <a class="btn btn-info btn-sm" href="{{ route('m_user.show', $m_user->user_id) }}"><i class="fas fa-eye"></i></a>
                                                <a class="btn btn-warning btn-sm" href="{{ route('m_user.edit', $m_user->user_id) }}"><i class="fas fa-edit"></i></a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection