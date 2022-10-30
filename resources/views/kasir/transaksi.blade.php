@extends('layout.main-kasir')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/image.css') }}">
    <link rel="stylesheet" href="{{ asset('css/scroll-table.css') }}">
@endsection

@section('main')
    <div class="row">
        <div class="col">
            <h2>Transaksi</h2>
            <hr>
            @if (Session::has('error'))
                <div class="alert alert-danger mt-2">{{ Session::get('error') }}</div>
            @endif
            @if (Session::has('success'))
                <div class="alert alert-success mt-2">{{ Session::get('success') }}</div>
            @endif
        </div>
    </div>
    <form action="{{ url('kasir/transaksi-tambah') }}" method="post">
        <div class="row">
            <div class="col-12 col-sm-6">
                List Minuman
                <div class="tableFixHead">
                    <table class="table table-striped table-dark">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Gambar</th>
                                <th scope="col">Category</th>
                                <th scope="col" style="text-align: right">Harga (Rp)</th>
                                <th scope="col" style="text-align: center">Pilih</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($minuman as $key => $m)
                                <tr class="align-middle">
                                    <th scope="row">{{ $m->id_minuman }}</th>
                                    <th scope="row">{{ $m->nama }}</th>
                                    <th scope="row"><img src='{{ asset("topping/$m->gambar") }}' alt="Tidak ada gambar">
                                    </th>
                                    <th scope="row">{{ $m->Category_Minuman->nama }}</th>
                                    <th scope="row" style="text-align: right">{{ $m->harga }}</th>
                                    <td style="text-align: center"><input type="radio" class="form-check-input"
                                            name="id_minuman" id="id_minuman" value="{{ $m->id_minuman }}"></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">Tidak ada data</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-12 col-sm-6">
                List Topping
                <div class="tableFixHead">
                    <table class="table table-striped table-dark">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Gambar</th>
                                <th scope="col" style="text-align: right">Harga (Rp)</th>
                                <th scope="col" style="text-align: center">Pilih</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($topping as $key => $t)
                                <tr class="align-middle">
                                    <th scope="row">{{ $t->id_topping }}</th>
                                    <th scope="row">{{ $t->nama }}</th>
                                    <th scope="row"><img src='{{ asset("topping/$t->gambar") }}' alt="Tidak ada gambar">
                                    </th>
                                    <th scope="row" class="ml-auto" style="text-align: right">{{ $t->harga }}</th>
                                    <td style="text-align: center"><input type="radio" class="form-check-input"
                                            name="id_topping" id="id_topping" value="{{ $t->id_topping }}"></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">Tidak ada data</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">

        </div>
    </form>
@endsection

@section('script')
    {{-- script jquery untuk ajax --}}
    <script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>
    {{-- script untuk ajax --}}
    <script>
        $(document).ready(function() {
            // jQuery('#ajaxSubmit').click(function(e){
            //    e.preventDefault();
            //    $.ajaxSetup({
            //       headers: {
            //           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            //       }
            //   });
            //    jQuery.ajax({
            //       url: "{{ url('/grocery/post') }}",
            //       method: 'post',
            //       data: {
            //          name: jQuery('#name').val(),
            //          type: jQuery('#type').val(),
            //          price: jQuery('#price').val()
            //       },
            //       success: function(result){
            //          console.log(result);
            //       }});
            //    });
        });
    </script>
@endsection
