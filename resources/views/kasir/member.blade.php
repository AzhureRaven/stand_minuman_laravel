@extends('layout.main-kasir')

@section('main')
    <h2>Register Member</h2>
    <hr>
    @if (Session::has('error'))
        <div class="alert alert-danger mt-2">{{ Session::get('error') }}</div>
    @endif

@endsection

@section('script')
    
@endsection
