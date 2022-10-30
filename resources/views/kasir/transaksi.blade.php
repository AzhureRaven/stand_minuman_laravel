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
    {{-- <form action="{{ url('kasir/transaksi-tambah') }}" method="post"> --}}
    <div class="row">
        <div class="col-12 col-lg-6">
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
        <div class="col-12 col-lg-6">
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
        <div class="form-group">
            <label>Jumlah</label>
            <input type="number" min="1" class="form-control" name="jumlah" id="jumlah">
        </div>
        <button type="button" id="tambah" class="btn btn-primary mt-2">Tambah</button>
    </div>
    <div class="row">
        <div class="col">
            Detail
            <div class="tableFixHead">
                <table class="table table-striped table-dark">
                    <thead>
                        <tr>
                            <th scope="col">Nama Minuman</th>
                            <th scope="col">Nama Topping</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col" style="text-align: right">Subtotal Minuman (Rp)</th>
                            <th scope="col" style="text-align: right">Subtotal Topping (Rp)</th>
                            <th scope="col" style="text-align: right">Subtotal (Rp)</th>
                            <th scope="col" style="text-align: center">Action</th>
                        </tr>
                    </thead>
                    <tbody id="dtrans">
                        @forelse (Session::get("transaksi.dtrans") as $key => $dtrans)
                            <tr class="align-middle">
                                <td scope="col">{{ $dtrans['nama_minuman'] }}</td>
                                <td scope="col">{{ $dtrans['nama_topping'] }}</td>
                                <td scope="col">{{ $dtrans['jumlah'] }}</td>
                                <td scope="col" style="text-align: right">{{ $dtrans['subtotal_minuman'] }}</td>
                                <td scope="col" style="text-align: right">{{ $dtrans['subtotal_topping'] }}</td>
                                <td scope="col" style="text-align: right">{{ $dtrans['subtotal'] }}</td>
                                <td scope="col" style="text-align: center"><button type="button"
                                        value={{ $key }} class="hapus btn btn-danger">Hapus</button></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">Tidak ada data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
    {{-- script jquery untuk ajax --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    {{-- script untuk ajax --}}
    <script>
        $(document).ready(function() {
            $('#tambah').click(function(e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ url('/kasir/add-item') }}",
                    method: 'post',
                    data: {
                        id_minuman: jQuery('input[name="id_minuman"]:checked').val(),
                        id_topping: jQuery('input[name="id_topping"]:checked').val(),
                        jumlah: jQuery('#jumlah').val()
                    },
                    success: function(result) {
                        refreshTransaksi()
                    }
                });
            });

            $('#dtrans').on("click", ".hapus", function(e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ url('/kasir/remove-item') }}",
                    method: 'post',
                    data: {
                        id: $(this).attr("value"),
                    },
                    success: function(result) {
                        refreshTransaksi()
                    }
                });
            });

            function refreshTransaksi() {
                $.ajax({
                    url: "{{ url('/kasir/get-item') }}",
                    method: 'get',
                    success: function(result) {
                        let res = JSON.parse(result)
                        let dtrans = res['dtrans']
                        console.log(dtrans)
                        let data = ""
                        for (let i = 0; i < dtrans.length; i++) {
                            data += "<tr class='align-middle'>";
                            data += "<td scope='col'>" + dtrans[i]["nama_minuman"] + "</td>"
                            data += "<td scope='col'>" + dtrans[i]["nama_topping"] + "</td>"
                            data += "<td scope='col'>" + dtrans[i]["jumlah"] + "</td>"
                            data += "<td scope='col' style='text-align: right'>" + dtrans[i][
                                "subtotal_minuman"
                            ] + "</td>"
                            data += "<td scope='col' style='text-align: right'>" + dtrans[i][
                                "subtotal_topping"
                            ] + "</td>"
                            data += "<td scope='col' style='text-align: right'>" + dtrans[i][
                                "subtotal"
                            ] + "</td>"
                            data += "<td scope='col' style='text-align: center'>" +
                                '<button type="button" value=' + i +
                                ' class="hapus btn btn-danger">Hapus</button>' + "</td>"
                            data += "</tr>";
                        }
                        if(dtrans.length <= 0){
                            data += "<tr><td colspan='7'>Tidak ada data</td></tr>"
                        }
                        //href="{{ url("kasir/remove-item/'+i+'") }}"
                        $("#dtrans").html(data)
                        $('.hapus').on("click", function(e) {
                            e.preventDefault();
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr(
                                        'content')
                                }
                            });
                        });
                    }
                });
            }
        });
    </script>
@endsection
