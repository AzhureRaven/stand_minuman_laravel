@extends('layout.main-admin')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/image.css') }}">
    <link rel="stylesheet" href="{{ asset('css/scroll-table.css') }}">
@endsection

@section('main')
    <h1>Master Users</h1>
    @php
        $new_id = DB::table('users')->count() + 1;
        if ($curUser) {
            $new_id = $curUser->id_users;
        }
    @endphp
    @if (Session::has('error'))
        <div class="alert alert-danger mt-2">{{ Session::get('error') }}</div>
    @endif
    @if (Session::has('success'))
        <div class="alert alert-success mt-2">{{ Session::get('success') }}</div>
    @endif
    @if ($errors->any())
        @foreach ($errors->all() as $err)
            <div class="alert alert-danger">{{ $err }}</div>
        @endforeach
    @endif
    <div class="container">
        <form action="{{ url('admin/users/simpan') }}" method="post">
            @csrf
            <div class="row py-2">
                <div class="col-sm">
                    <label for="">Id User:</label>
                    <input type="text" name="id_users" class="form-control" value="{{ $new_id }}" readonly>
                </div>
                <div class="col-sm"></div>
            </div>
            <div class="row py-2">
                <div class="col-sm">
                    <label for="">Username:</label>
                    <input type="text" maxlength="30" name="username" class="form-control"
                        @if ($curUser) value="{{ $curUser->username }}" @endif
                        placeholder="Input username user">
                </div>
                <div class="col-sm"></div>
            </div>
            <div class="row py-2">
                <div class="col-sm">
                    <label for="">Nama:</label>
                    <input type="text" maxlength="100" name="nama" class="form-control"
                        @if ($curUser) value="{{ $curUser->nama }}" @endif placeholder="Input nama user">
                </div>
                <div class="col-sm"></div>
            </div>
            <div class="row py-2">
                <div class="col-sm">
                    <label for="">Password Baru:</label>
                    <input type="text" name="password" class="form-control" placeholder="Input Password">
                </div>
                <div class="col-sm"></div>
            </div>
            <div class="row py-2">
                <div class="col-sm">
                    @if ($curUser)
                        <input type="submit" name="type" class="btn btn-primary" value="Update">
                    @else
                        <input type="submit" name="type" class="btn btn-primary" value="Insert">
                    @endif
                </div>
                <div class="col-sm"></div>
            </div>
        </form>
    </div>
    <h2>Data</h2>
    <div class="tableFixHead">
        <table class="table table-striped table-dark">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Username</th>
                    <th scope="col">Nama</th>
                    <th scope="col" style="text-align: center">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $key => $m)
                    <tr class="align-middle">
                        <td scope="row">{{ $m->id_users }}</td>
                        <td scope="row">{{ $m->username }}</td>
                        <td scope="row">{{ $m->nama }}</td>
                        <td style="text-align: center">
                            <a href='{{ url("admin/users/$m->id_users") }}'
                                class="btn btn-info">Update</a>
                            @if ($m->deleted_at)
                                <a href='{{ url("admin/users/restore/$m->id_users") }}'
                                    class="btn btn-success">Restore</a>
                            @else
                                <a href='{{ url("admin/users/delete/$m->id_users") }}'
                                    class="btn btn-danger">Delete</a>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">Tidak ada data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
