<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" style="padding:10px">
    <a class="navbar-brand">Admin: {{Auth::user()->nama}}</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a active class="nav-link active" href="{{ url('/admin/minuman') }}">Master Minuman</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{ url('/admin/category_minuman') }}">Master Category Minuman</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{ url('/admin/topping') }}">Master Topping</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{ url('/admin/member') }}">Master Member</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{ url('/admin/users') }}">Master Users</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{ url('/admin/diskon') }}">Master Diskon</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{ url('/admin/laporan_penjualan') }}">Laporan Penjualan</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-danger" href="{{ url('logout') }}">Logout</a>
            </li>
          </ul>
      </div>
  </nav>
