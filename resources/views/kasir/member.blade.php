@extends('layout.main-kasir')

@section('css')

@endsection

@section('main')
    <div class="row">
        <div class="col">
            <h2>Register Member</h2>
            <hr>
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
        </div>
    </div>
    <div class="row">
        <div class="col">
            <form action="{{ url('kasir/member/add-member') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Nama Member</label>
                    <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Member" maxlength="50" value="{{ old('nama') }}">
                </div>
                <div class="form-group">
                    <label>Email Member</label>
                    <input type="text" class="form-control" name="email" id="email" placeholder="Email Member" maxlength="50" value="{{ old('email') }}">
                </div>
                <button type="submit" class="btn btn-primary mt-2">Register</button>
            </form>
        </div>
    </div>
@endsection

@section('script')

@endsection
