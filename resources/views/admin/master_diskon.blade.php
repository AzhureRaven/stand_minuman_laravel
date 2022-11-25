@extends('layout.main-admin')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/image.css') }}">
    <link rel="stylesheet" href="{{ asset('css/scroll-table.css') }}">
@endsection

@section('main')
    <h1>Master Diskon</h1>
    @php
        $new_id = DB::table('diskon')->count() + 1;
        if ($curDiskon) {
            $new_id = $curDiskon->id_diskon;
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
        <form action="{{ url('admin/diskon/simpan') }}" method="post">
            @csrf
            <div class="row py-2">
                <div class="col-sm">
                    <label for="">Id Diskon:</label>
                    <input type="text" name="id_diskon" class="form-control" value="{{ $new_id }}" readonly>
                </div>
                <div class="col-sm"></div>
            </div>
            <div class="row py-2">
                <div class="col-sm">
                    <label for="">Nama Diskon:</label>
                    <input type="text" maxlength="30" name="nama" class="form-control"
                        @if ($curDiskon) value="{{ $curDiskon->nama }}" @endif
                        placeholder="Input nama diskon">
                </div>
                <div class="col-sm"></div>
            </div>
            <div class="row py-2">
                <div class="col-sm">
                    <label for="">Potongan:</label>
                    <input type="number" min="0" max="100" name="potongan" class="form-control"
                        @if ($curDiskon) value="{{ $curDiskon->potongan }}" @endif
                        placeholder="Input nama diskon">
                </div>
                <div class="col-sm"></div>
            </div>
            <div class="row py-2">
                <div class="col-sm">
                    @if ($curDiskon)
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
                    <th scope="col">Nama</th>
                    <th scope="col">Potongan (%)</th>
                    <th scope="col" style="text-align: center">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($diskon as $key => $m)
                    <tr class="align-middle">
                        <td scope="row">{{ $m->id_diskon }}</td>
                        <td scope="row">{{ $m->nama }}</td>
                        <td scope="row">{{ $m->potongan }}</td>
                        <td style="text-align: center">
                            <a href='{{ url("admin/diskon/$m->id_diskon") }}'
                                class="btn btn-info">Update</a>
                            @if ($m->deleted_at)
                                <a href='{{ url("admin/diskon/restore/$m->id_diskon") }}'
                                    class="btn btn-success">Restore</a>
                            @else
                                <a href='{{ url("admin/diskon/delete/$m->id_diskon") }}'
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
