@extends('layout.main-login')

@section('main')
    @if (Session::has('error'))
        <div class="alert alert-danger">{{ Session::get('error') }}</div>
    @endif
    @if ($errors->any())
        @foreach ($errors->all() as $err)
            <div class="alert alert-danger">{{ $err }}</div>
        @endforeach
    @endif
    <h3>Login</h3>
    <hr />
    <form action="{{ url('/do-login') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Username</label>
            <input type="text" class="form-control" name="username" id="username" placeholder="Username" value="{{ old('username') }}">
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Password">
        </div>
        <button type="submit" class="btn btn-primary mt-2">Login</button>
    </form>
@endsection
