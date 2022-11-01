@extends('layout.main-admin')

@section('main')
<h1>Master Minuman</h1>
@php
    $category=DB::table('category_minuman')->get();
    $new_id=DB::table('minuman')->count()+1;
@endphp
<div class="container">
    <form action=""  method="post">
        <input type="hidden" name="id_minuman" value="{{$new_id}}">
        <div class="row py-2">
            <div class="col-sm">
                <label for="">Nama Minuman:</label>
                <input type="text" name="nama" id="" class="form-control" placeholder="input nama minuman">
            </div>
            <div class="col-sm"></div>
        </div>
        <div class="row py-2">
            <div class="col-sm">
                <label for="">Gambar Minuman:</label>
                <input type="text" name="gambar" id="" class="form-control" placeholder="input gambar Minuman" src="">
            </div>
            <div class="col-sm"></div>
        </div>
        <div class="row py-2">
            <div class="col-sm">
                <label for="">Harga Minuman:</label>
                <input type="number" name="" id="" class="form-control" placeholder="input harga minuman" src="">
            </div>
            <div class="col-sm"></div>
        </div>
        <div class="row py-2">
            <div class="col-sm">
                <label for="">Category Minuman:</label>
                <br>
                <select name="category_minuman" id="" class="form-control">
                    @foreach ($category as $categories)
                        <option value="{{$categories->id_category_minuman}}">{{$categories->nama}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm"></div>
        </div>
        <div class="row py-2">
            <div class="col-sm">
                <input type="submit"  id="" class="btn btn-primary" value="insert" src="">
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
                    <td scope="row">{{ $m->nama }}</td>
                    <td scope="row"><img src='{{ asset("topping/$m->gambar") }}' alt="Tidak ada gambar"></td>
                    <td scope="row">{{ $m->Category_Minuman->nama }}</td>
                    <td scope="row" style="text-align: right">{{ $m->harga }}</td>
                    <td style="text-align: center">
                        <a href="" class="btn btn-info">Update</a>
                        <a href="" class="btn btn-danger">Delete</a>
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
