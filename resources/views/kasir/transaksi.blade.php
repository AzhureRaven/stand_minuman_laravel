@extends('layout.main-kasir')

@section('main')
    <h2>Transaksi</h2>
    <hr>
    @if (Session::has('error'))
        <div class="alert alert-danger mt-2">{{ Session::get('error') }}</div>
    @endif
    @if (Session::has('success'))
        <div class="alert alert-success mt-2">{{ Session::get('success') }}</div>
    @endif

@endsection

@section('script')
    {{-- script untuk ajax --}}
    <script>

    </script>
@endsection
