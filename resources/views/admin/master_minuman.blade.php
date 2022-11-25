@extends('layout.main-admin')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/image.css') }}">
    <link rel="stylesheet" href="{{ asset('css/scroll-table.css') }}">
@endsection

@section('main')
<h1>Master Minuman</h1>
@php
    $category=DB::table('category_minuman')->get();
    $new_id=DB::table('minuman')->count()+1;
    if ($curMinuman) {
            $new_id = $curMinuman->id_minuman;
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
    <form action="/admin/minuman/simpan" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row py-2">
            <div class="col-sm">
                <label for="">Id Minuman:</label>
                <input type="text" name="id_minuman" class="form-control" value="{{ $new_id }}" readonly>
            </div>
            <div class="col-sm"></div>
        </div>
        <div class="row py-2">
            <div class="col-sm">
                <label for="">Nama Minuman:</label>
                <input type="text" name="nama" id="" class="form-control" placeholder="input nama minuman" @if ($curMinuman) value="{{ $curMinuman->nama }}" @endif>
            </div>
            <div class="col-sm"></div>
        </div>
        <div class="row py-2">
            <div class="col-sm">
                <label for="">Gambar Minuman:</label>
                <input type="file" name="gambar" id="" class="form-control" placeholder="input gambar Minuman" src="" @if ($curMinuman) value="{{ $curMinuman->gambar }}" @endif>
            </div>
            <div class="col-sm"></div>
        </div>
        <div class="row py-2">
            <div class="col-sm">
                <label for="">Harga Minuman:</label>
                <input type="number" name="harga" id="" class="form-control" placeholder="input harga minuman" @if ($curMinuman) value="{{ $curMinuman->harga }}" @endif>
            </div>
            <div class="col-sm"></div>
        </div>
        <div class="row py-2">
            <div class="col-sm">
                <label for="">Category Minuman:</label>
                <br>
                <select name="category_minuman" id="" class="form-control" selected="3">
                    @foreach ($category as $categories)
                        @if ($curMinuman!=[])
                            @if ($curMinuman->id_category_minuman==$categories->id_category_minuman)
                                <option value="{{$categories->id_category_minuman}}" selected="selected">{{$categories->nama}}</option>
                            @else
                                <option value="{{$categories->id_category_minuman}}">{{$categories->nama}}</option>
                            @endif
                        @else
                        <option value="{{$categories->id_category_minuman}}" >{{$categories->nama}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="col-sm"></div>
        </div>
        <div class="row py-2">
            <div class="col-sm">
                @if ($curMinuman)
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
                <th scope="col">Gambar</th>
                <th scope="col">Category</th>
                <th scope="col" style="text-align: right">Harga (Rp)</th>
                <th scope="col" style="text-align: center">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($minuman as $key => $m)
                <tr class="align-middle">
                    <td scope="row">{{ $m->id_minuman }}</td>
                    <td scope="row">{{ $m->nama }}</td>
                    <td scope="row"><img src='{{ asset("storage/minuman/$m->gambar") }}' alt="Tidak ada gambar"></td>
                    <td scope="row">{{ $m->Category_Minuman->nama }}</td>
                    <td scope="row" style="text-align: right">{{ $m->harga }}</td>
                    <td style="text-align: center">
                        <a href='{{ url("admin/minuman/$m->id_minuman") }}'
                            class="btn btn-info">Update</a>
                        @if ($m->deleted_at)
                            <a href="{{ url("admin/minuman/restore/$m->id_minuman") }}"
                                class="btn btn-success">Restore</a>
                        @else
                            <a href="{{ url("admin/minuman/delete/$m->id_minuman") }}"
                                class="btn btn-danger">Delete</a>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Tidak ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
