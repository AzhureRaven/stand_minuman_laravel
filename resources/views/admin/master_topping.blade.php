@extends('layout.main-admin')

@section('main')
<h1>Master Topping</h1>
@php
    $new_id=DB::table('topping')->count()+1;
@endphp
<div class="container">
    <form action=""  method="post">
        <input type="hidden" name="id_topping" value="{{$new_id}}">
        <div class="row py-2">
            <div class="col-sm">
                <label for="">Nama Topping:</label>
                <input type="text" name="nama" id="" class="form-control" placeholder="input nama topping">
            </div>
            <div class="col-sm"></div>
        </div>
        <div class="row py-2">
            <div class="col-sm">
                <label for="">Gambar Topping:</label>
                <input type="file" name="gambar" id="" class="form-control" placeholder="input gambar topping">
            </div>
            <div class="col-sm"></div>
        </div>
        <div class="row py-2">
            <div class="col-sm">
                <label for="">Harga Topping:</label>
                <input type="text" name="harga" id="" class="form-control" placeholder="input harga topping">
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
                <th scope="col" >Nama</th>
                <th scope="col" >Gambar</th>
                <th scope="col" >Harga</th>
                <th scope="col" style="text-align: center">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($topping as $key => $m)
                <tr class="align-middle">
                    <td scope="row" >{{ $m->nama }}</td>
                    <td scope="row" ><img src='{{ asset("topping/$m->gambar") }}' alt="Tidak ada gambar"></td>
                    <td scope="row" >{{ $m->harga }}</td>
                    <td style="text-align: center" >
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
