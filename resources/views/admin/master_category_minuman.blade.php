@extends('layout.main-admin')

@section('main')
    <h1>Master Category Minuman</h1>
    @php
        $new_id = DB::table('category_minuman')->count() + 1;
        if ($curCategory) {
            $new_id = $curCategory->id_category_minuman;
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
        <form action="{{ url('admin/category_minuman/simpan') }}" method="post">
            @csrf
            <div class="row py-2">
                <div class="col-sm">
                    <label for="">Id Category:</label>
                    <input type="text" name="id_category_minuman" class="form-control" value="{{ $new_id }}" readonly>
                </div>
                <div class="col-sm"></div>
            </div>
            <div class="row py-2">
                <div class="col-sm">
                    <label for="">Nama Category:</label>
                    <input type="text" maxlength="30" name="nama" class="form-control"
                        @if ($curCategory) value="{{ $curCategory->nama }}" @endif
                        placeholder="Input nama category">
                </div>
                <div class="col-sm"></div>
            </div>
            <div class="row py-2">
                <div class="col-sm">
                    @if ($curCategory)
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
                    <th scope="col" style="text-align: center">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($category as $key => $m)
                    <tr class="align-middle">
                        <td scope="row">{{ $m->id_category_minuman }}</td>
                        <td scope="row">{{ $m->nama }}</td>
                        <td style="text-align: center">
                            @if ($m->id_category_minuman != 1)
                                <a href='{{ url("admin/category_minuman/$m->id_category_minuman") }}'
                                    class="btn btn-info">Update</a>
                                @if ($m->deleted_at)
                                    <a href="{{ url("admin/category_minuman/restore/$m->id_category_minuman") }}"
                                        class="btn btn-success">Restore</a>
                                @else
                                    <a href="{{ url("admin/category_minuman/delete/$m->id_category_minuman") }}"
                                        class="btn btn-danger">Delete</a>
                                @endif
                            @else
                                Category Tidak Boleh Diedit
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">Tidak ada data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
