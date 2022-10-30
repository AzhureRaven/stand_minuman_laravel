@extends('layout.main-kasir')

@section('main')
    <h2>Transaksi</h2>
    <hr>
    @if (Session::has('error'))
        <div class="alert alert-danger mt-2">{{ Session::get('error') }}</div>
    @endif

@endsection

@section('script')
    {{-- script untuk ajax --}}
    <script>

    </script>
@endsection
