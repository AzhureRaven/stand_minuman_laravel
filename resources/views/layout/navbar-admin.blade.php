<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02"
            aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="nav nav-pills me-auto mb-2 mb-lg-0">
                {{-- <li class="nav-item">
                    <a href="#" disabled class="nav-link disabled text-white">Kasir: {{Auth::user()->nama}}</a>
                </li> --}}
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/admin/minuman') }}">Master Minuman</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/admin/category_minuman') }}">Master Category Minuman</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/admin/topping') }}">Master Topping</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/admin/member') }}">Master Member</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/admin/users') }}">Master Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/admin/diskon') }}">Master Diskon</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/admin/laporan_penjualan') }}">Laporan Penjualan</a>
                </li>
            </ul>
            <ul class="nav nav-pills ml-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('logout') }}">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
