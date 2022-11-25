@extends('layout.main-admin')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/image.css') }}">
    <link rel="stylesheet" href="{{ asset('css/scroll-table.css') }}">
@endsection

@section('main')
    <h1>Laporan Penjualan</h1>
    <div class="row">
        <div class="col-sm">
            <label for="">Tanggal Awal:</label>
            <input type="date" name="tgl_awal" id="tgl_awal" class="form-control">
        </div>
        <div class="col-sm">
            <label for="">Tanggal Akhir:</label>
            <input type="date" name="tgl_akhir" id="tgl_akhir" class="form-control">
        </div>
        <div class="col-sm">
            <br>
            <button type="button" id="filter" class="btn btn-primary">Filter</button>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <h2>Transaksi</h2>
            <div class="tableFixBottom">
                <table class="table table-striped table-dark">
                    <thead>
                        <tr>
                            <th scope="col">No. Nota</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Kasir</th>
                            <th scope="col">Member</th>
                            <th scope="col" style="text-align: right">Subtotal (Rp)</th>
                            <th scope="col">Diskon</th>
                            <th scope="col" style="text-align: right">Potongan (Rp)</th>
                            <th scope="col" style="text-align: right">Total (Rp)</th>
                            <th scope="col" style="text-align: center">Action</th>
                        </tr>
                    </thead>
                    <tbody id="htrans">
                        @forelse ($htrans as $key => $ht)
                            <tr class="align-middle">
                                <td scope="col">{{ $ht->no_nota }}</td>
                                <td scope="col">{{ $ht->tanggal }}</td>
                                <td scope="col">
                                    @if ($ht->Users)
                                    {{ $ht->Users->nama }}
                                    @endif
                                </td>
                                <td scope="col">
                                    @if ($ht->Member)
                                    {{ $ht->Member->nama }}
                                    @endif
                                </td>
                                <td scope="col" style="text-align: right">{{ number_format($ht->subtotal,2,',','.') }}</td>
                                <td scope="col">
                                    @if ($ht->Diskon)
                                    {{ $ht->Diskon->nama }}
                                    @endif
                                </td>
                                <td scope="col" style="text-align: right">{{ number_format($ht->potongan,2,',','.') }}</td>
                                <td scope="col" style="text-align: right">{{ number_format($ht->total,2,',','.') }}</td>
                                <td scope="col" style="text-align: center"><button type="button"
                                        value="{{ $ht->no_nota }}"" class="detail btn btn-success">Detail</button></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9">Tidak ada data</td>
                            </tr>
                        @endforelse
                        <tr>
                            <td colspan="7" style="text-align: right">Grand Total:</td>
                            <td style="text-align: right" id="grandtotal">{{ number_format($grandtotal,2,',','.') }}</td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <h2>Detail</h2>
            <h4 id="no_nota">No. Nota: </h4>
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
                        </tr>
                    </thead>
                    <tbody id="dtrans">
                        <tr>
                            <td colspan="9">Tidak ada data</td>
                        </tr>
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
                $('#filter').click(function(e) {
                    e.preventDefault();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{ url('/admin/laporan_penjualan/filter') }}",
                        method: 'post',
                        data: {
                            tgl_awal: $('input[name="tgl_awal"]').val(),
                            tgl_akhir: $('input[name="tgl_akhir"]').val()
                        },
                        success: function(result) {
                            $("#htrans").html(result)
                            clear()
                        }
                    });
                });


                $('#htrans').on("click", ".detail", function(e) {
                    let no_nota = $(this).val()
                    e.preventDefault();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{ url('/admin/laporan_penjualan/detail') }}",
                        method: 'post',
                        data: {
                            no_nota: no_nota
                        },
                        success: function(result) {
                            $("#dtrans").html(result)
                            $("#no_nota").text("No. Nota: "+no_nota)
                        }
                    });
                });

                function clear() {
                    let cleared = "<tr><td colspan='7'>Tidak ada data</td></tr>"
                    $("#dtrans").html(cleared)
                    $("#no_nota").text("No. Nota:")
                }
            });
        </script>
    @endsection
