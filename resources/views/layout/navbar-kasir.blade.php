<nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-dark" style="padding:10px">
    <a class="navbar-brand">Kasir: {{Auth::user()->nama}}</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
            <a class="nav-link active" href="{{ url('kasir/transaksi') }}">Transaksi</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="{{ url('kasir/member') }}">Register Member</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-danger" href="{{ url('logout') }}">Logout</a>
        </li>
      </ul>
    </div>
  </nav>
