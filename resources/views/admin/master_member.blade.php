@extends('layout.main-admin')

@section('main')
<h1>Master Member</h1>
@php
    $new_id=DB::table('member')->count()+1;
@endphp
<div class="container">
    <form action=""  method="post">
        <input type="hidden" name="id_member" value="{{$new_id}}">
        <div class="row py-2">
            <div class="col-sm">
                <label for="">Nama Member:</label>
                <input type="text" name="nama" id="" class="form-control" placeholder="input nama member">
            </div>
            <div class="col-sm"></div>
        </div>
        <div class="row py-2">
            <div class="col-sm">
                <label for="">Email Member:</label>
                <input type="text" name="gambar" id="" class="form-control" placeholder="input email member">
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
                <th scope="col" >Email</th>
                <th scope="col" style="text-align: center">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($member as $key => $m)
                <tr class="align-middle">
                    <td scope="row" >{{ $m->nama }}</td>
                    <td scope="row" >{{ $m->email }}</td>
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
