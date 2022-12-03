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
            <h2>List Minuman</h2>
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
                                <td scope="row">{{ $m->id_minuman }}</td>
                                <td scope="row">{{ $m->nama }}</td>
                                <td scope="row"><img src='{{ asset("storage/minuman/$m->gambar") }}' alt="Tidak ada gambar">
                                </td>
                                <td scope="row">{{ $m->Category_Minuman->nama }}</td>
                                <td scope="row" style="text-align: right">{{ number_format($m->harga,2,',','.') }}</td>
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
            <h2>List Topping</h2>
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
                                <td scope="row">{{ $t->id_topping }}</td>
                                <td scope="row">{{ $t->nama }}</td>
                                <td scope="row"><img src='{{ asset("storage/topping/$t->gambar") }}' alt="Tidak ada gambar">
                                </td>
                                <td scope="row" class="ml-auto" style="text-align: right">{{ number_format($t->harga,2,',','.') }}</td>
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
    <div class="row mb-4">
        <div class="form-group">
            <label>Jumlah</label>
            <input type="number" min="1" class="form-control" value="0" name="jumlah" id="jumlah">
        </div>
        <button type="button" id="tambah" class="btn btn-primary mt-2">Tambah</button>
    </div>
    <div class="row">
        <div class="col">
            <h2>Detail</h2>
            <div class="tableFixBottom">
                <table class="table table-striped table-dark">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Minuman</th>
                            <th scope="col">Gambar Minuman</th>
                            <th scope="col">Nama Topping</th>
                            <th scope="col">Gambar Topping</th>
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
                                <td scope="col">{{ ($key+1) }}</td>
                                <td scope="col">{{ $dtrans['nama_minuman'] }}</td>
                                @php
                                    $gbr = $dtrans['gbr_minuman']
                                @endphp
                                <td scope="col"><img src='{{ asset("storage/minuman/$gbr") }}' alt="Tidak ada gambar"></td>
                                <td scope="col">{{ $dtrans['nama_topping'] }}</td>
                                @php
                                    $gbr = $dtrans['gbr_topping']
                                @endphp
                                <td scope="col"><img src='{{ asset("storage/topping/$gbr") }}' alt="Tidak ada gambar"></td>
                                <td scope="col">{{ $dtrans['jumlah'] }}</td>
                                <td scope="col" style="text-align: right">{{ number_format($dtrans['subtotal_minuman'],2,',','.') }}</td>
                                <td scope="col" style="text-align: right">{{ number_format($dtrans['subtotal_topping'],2,',','.') }}</td>
                                <td scope="col" style="text-align: right">{{ number_format($dtrans['subtotal'],2,',','.') }}</td>
                                <td scope="col" style="text-align: center"><button type="button"
                                        value={{ $key }} class="hapus btn btn-danger">Hapus</button></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10">Tidak ada data</td>
                            </tr>
                        @endforelse
                    </tbody>
                        <tr>
                            <td colspan="8" style="text-align: right">Subtotal:</td>
                            <td style="text-align: right" id="subtotal">Rp {{ number_format(Session::get('transaksi.subtotal'),2,',','.') }}</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="8" style="text-align: right">Diskon:</td>
                            <td style="text-align: right">
                                <select class="form-select" name="diskon" id="diskon">
                                    <option value="-1" {{ Session::get('transaksi.id_diskon') == -1 ? 'selected' : '' }}>
                                        No Diskon - 0%</option>
                                    @foreach ($diskon as $d)
                                        <option {{ Session::get('transaksi.id_diskon') == $d->id_diskon ? 'selected' : '' }}
                                            value="{{ $d->id_diskon }}">{{ $d->nama.' - '.$d->potongan.'%'  }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="8" style="text-align:right">Member (Diskon 20%):</td>
                            <td style="text-align: right">
                                <select class="form-select" name="member" id="member">
                                    <option value="-1" {{ Session::get('transaksi.id_member') == -1 ? 'selected' : '' }}>
                                        No Member</option>
                                    @foreach ($member as $m)
                                        <option {{ Session::get('transaksi.id_member') == $m->id_member ? 'selected' : '' }}
                                            value="{{ $m->id_member }}">{{ $m->nama }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="8" style="text-align:right">Potongan:</td>
                            <td style="text-align: right" id="potongan">Rp {{ number_format(Session::get('transaksi.potongan'),2,',','.') }}</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="8" style="text-align: right">Total:</td>
                            <td style="text-align: right" id="total">Rp {{ number_format(Session::get('transaksi.total'),2,',','.') }}</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="8" style="text-align: right"></td>
                            <td style="text-align: right">
                                <button type="button" id="clear"  class="btn btn-danger">Hapus Semua</button>
                            </td>
                            <td>
                                <form action="{{ url('kasir/transaksi/do-transaksi') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Transaksi</button>
                                </form>
                            </td>
                        </tr>
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
                    url: "{{ url('/kasir/transaksi/add-item') }}",
                    method: 'post',
                    data: {
                        id_minuman: $('input[name="id_minuman"]:checked').val(),
                        id_topping: $('input[name="id_topping"]:checked').val(),
                        jumlah: $('#jumlah').val()
                    },
                    success: function(result) {
                        refreshTransaksi()
                        clearSelection()
                    }
                });
            });

            function clearSelection(){
                $('input[name="id_minuman"]:checked').prop('checked', false);
                $('input[name="id_topping"]:checked').prop('checked', false);
                $('#jumlah').val(0)
            }

            $('#dtrans').on("click", ".hapus", function(e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ url('/kasir/transaksi/remove-item') }}",
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
                    url: "{{ url('/kasir/transaksi/get-item') }}",
                    method: 'get',
                    success: function(result) {
                        let res = JSON.parse(result)
                        let dtrans = res['dtrans']
                        console.log(dtrans)
                        let data = res['data']
                        // for (let i = 0; i < dtrans.length; i++) {
                        //     data += "<tr class='align-middle'>";
                        //     data += "<td scope='col'>" + (i+1) + "</td>"
                        //     data += "<td scope='col'>" + dtrans[i]["nama_minuman"] + "</td>"
                        //     data += "<td scope='col'>" + dtrans[i]["nama_topping"] + "</td>"
                        //     data += "<td scope='col'>" + dtrans[i]["jumlah"] + "</td>"
                        //     data += "<td scope='col' style='text-align: right'>" + dtrans[i][
                        //         "subtotal_minuman"
                        //     ] + "</td>"
                        //     data += "<td scope='col' style='text-align: right'>" + dtrans[i][
                        //         "subtotal_topping"
                        //     ] + "</td>"
                        //     data += "<td scope='col' style='text-align: right'>" + dtrans[i][
                        //         "subtotal"
                        //     ] + "</td>"
                        //     data += "<td scope='col' style='text-align: center'>" +
                        //         '<button type="button" value=' + i +
                        //         ' class="hapus btn btn-danger">Hapus</button>' + "</td>"
                        //     data += "</tr>";
                        // }
                        // if (dtrans.length <= 0) {
                        //     data += "<tr><td colspan='8'>Tidak ada data</td></tr>"
                        // }
                        $("#dtrans").html(data)
                        $('#subtotal').text("Rp " + res['subtotal'])
                        $('#potongan').text("Rp " + res['potongan'])
                        $('#total').text("Rp " + res['total'])
                    }
                });
            }

            $('#clear').click(function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ url('/kasir/transaksi/clear-item') }}",
                    method: 'get',
                    success: function(result) {
                        refreshTransaksi()
                    }
                });
            });

            $('#diskon').on('change', function(e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ url('/kasir/transaksi/change-diskon') }}",
                    method: 'post',
                    data: {
                        id: this.value,
                    },
                    success: function(result) {
                        refreshTransaksi()
                    }
                });
            });

            $('#member').on('change', function(e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ url('/kasir/transaksi/change-member') }}",
                    method: 'post',
                    data: {
                        id: this.value,
                    },
                    success: function(result) {
                        refreshTransaksi()
                    }
                });
            });
        });
    </script>
@endsection
