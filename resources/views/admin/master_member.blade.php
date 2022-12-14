@extends('layout.main-admin')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/image.css') }}">
    <link rel="stylesheet" href="{{ asset('css/scroll-table.css') }}">
@endsection

@section('main')
<h1>Master Member</h1>
@php
    $new_id=DB::table('member')->count()+1;
    if ($curMember) {
            $new_id = $curMember->id_member;
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
    <form action="{{url('/admin/member/simpan')}}"  method="post">
        @csrf
        <div class="row py-2">
            <div class="col-sm">
                <label for="">Id Member:</label>
                <input type="text" name="id_member" class="form-control" value="{{ $new_id }}" readonly>
            </div>
            <div class="col-sm"></div>
        </div>
        <input type="hidden" name="id_member" value="{{$new_id}}">
        <div class="row py-2">
            <div class="col-sm">
                <label for="">Nama Member:</label>
                <input type="text" name="nama" id="" class="form-control" placeholder="Input nama member" @if ($curMember) value="{{ $curMember->nama }}" @endif>
            </div>
            <div class="col-sm"></div>
        </div>
        <div class="row py-2">
            <div class="col-sm">
                <label for="">Email Member:</label>
                <input type="text" name="email" id="" class="form-control" placeholder="Input email member" @if ($curMember) value="{{ $curMember->email }}" @endif>
            </div>
            <div class="col-sm"></div>
        </div>
        <div class="row py-2">
            <div class="col-sm">
                @if ($curMember)
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
                <th scope="col" >Id</th>
                <th scope="col" >Nama</th>
                <th scope="col" >Email</th>
                <th scope="col" style="text-align: center">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($member as $key => $m)
                <tr class="align-middle">
                    <td scope="row">{{ $m->id_member }}</td>
                    <td scope="row" >{{ $m->nama }}</td>
                    <td scope="row" >{{ $m->email }}</td>
                    <td style="text-align: center" >
                        <a href='{{ url("admin/member/$m->id_member") }}'
                            class="btn btn-primary">Update</a>
                        @if ($m->deleted_at)
                            <a href="{{ url("admin/member/restore/$m->id_member") }}"
                                class="btn btn-success">Restore</a>
                        @else
                            <a href="{{ url("admin/member/delete/$m->id_member") }}"
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
<br>
<div class="container">
    <h2>Kirim Email</h2>
    <form action="{{url('/admin/member/email')}}"  method="post">
        @csrf
        <div class="row py-2">
            <div class="col-sm">
                <label for="">Subject</label><br>
                <input type="text" name="subject" class="form-control" value="{{ old('header') }}">
            </div>
        </div>
        <div class="row py-2">
            <div class="col-sm">
                <label for="">Body</label><br>
                <textarea class="form-control" name="body" rows="10">
                    {{ old('body') }}
                </textarea>
            </div>
        </div>
        <div class="row py-2">
            <div class="col-sm d-flex flex-row-reverse">
                <input type="submit" name="type" class="btn btn-primary" value="Kirim">
                <input type="submit" name="type" class="btn btn-primary me-2" value="Preview">
            </div>
        </div>
        <div class="row py-2">
            <div class="col-sm d-flex flex-row-reverse">
                <sup>*E-Mail hanya terkirim ke member aktif</sup>
            </div>
        </div>
    </form>
</div>
@endsection
