@extends('layout.main-admin')

@section('main')
    <h1>Master Topping</h1>
    @php
        $new_id = DB::table('topping')->count() + 1;
        if ($curTopping) {
            $new_id = $curTopping->id_topping;
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
        <form action="/admin/topping/simpan" method="post">
            @csrf
            <div class="row py-2">
                <div class="col-sm">
                    <label for="">Id Topping:</label>
                    <input type="text" name="id_topping" class="form-control" value="{{ $new_id }}" readonly>
                </div>
                <div class="col-sm"></div>
            </div>
            <div class="row py-2">
                <div class="col-sm">
                    <label for="">Nama Topping:</label>
                    <input type="text" name="nama" id="" class="form-control"
                        placeholder="input nama topping"
                        @if ($curTopping) value="{{ $curTopping->nama }}" @endif>
                </div>
                <div class="col-sm"></div>
            </div>
            <div class="row py-2">
                <div class="col-sm">
                    <label for="">Gambar Topping:</label>
                    <input type="file" name="gambar" id="" class="form-control"
                        placeholder="input gambar topping"
                        @if ($curTopping) value="{{ $curTopping->gambar }}" @endif>
                </div>
                <div class="col-sm"></div>
            </div>
            <div class="row py-2">
                <div class="col-sm">
                    <label for="">Harga Topping:</label>
                    <input type="number" name="harga" id="" class="form-control"
                        placeholder="input harga topping"
                        @if ($curTopping) value="{{ $curTopping->harga }}" @endif>
                </div>
                <div class="col-sm"></div>
            </div>
            <div class="row py-2">
                <div class="col-sm">
                    @if ($curTopping)
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
                    <th scope="col">Id</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Gambar</th>
                    <th scope="col">Harga</th>
                    <th scope="col" style="text-align: center">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($topping as $key => $m)
                    <tr class="align-middle">
                        <td scope="row">{{ $m->id_topping }}</td>
                        <td scope="row">{{ $m->nama }}</td>
                        <td scope="row"><img src='{{ asset("topping/$m->gambar") }}' alt="Tidak ada gambar"
                                style="width: 10em ;height: 10em;"></td>
                        <td scope="row">{{ $m->harga }}</td>
                        <td style="text-align: center">
                            @if ($m->id_topping != 1)
                                <a href='{{ url("admin/topping/$m->id_topping") }}' class="btn btn-info">Update</a>
                                @if ($m->deleted_at)
                                    <a href="{{ url("admin/topping/restore/$m->id_topping") }}"
                                        class="btn btn-success">Restore</a>
                                @else
                                    <a href="{{ url("admin/topping/delete/$m->id_topping") }}"
                                        class="btn btn-danger">Delete</a>
                                @endif
                            @else
                                Topping Tidak Boleh Diedit
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
@endsection
