<nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow navbar-static-top navbar-light">
  <div class="navbar-wrapper">
    <div class="navbar-header">
      <ul class="nav navbar-container navbar-nav flex-row">
        <li class="nav-item mobile-menu d-md-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu font-large-1"></i></a></li>
        <li class="nav-item">
          <a class="navbar-brand" href="index.html">
            <img class="brand-logo" alt="modern admin logo" src="{{ $profile->logo_url }}">
            <h3 class="brand-text">{{ $profile->title }}</h3>
          </a>
        </li>
      </ul>
    </div>
    <div class="navbar-container content">
      <div class="collapse navbar-collapse">
        <ul class="nav navbar-nav mr-auto float-left"> </ul>
        <ul class="nav navbar-nav float-right">
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="ficon ft-facebook"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="ficon ft-twitter"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="ficon ft-instagram"></i>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</nav>

<div class="header-navbar navbar-expand-sm navbar navbar-horizontal navbar-fixed navbar-dark navbar-without-dd-arrow navbar-shadow"
role="navigation" data-menu="menu-wrapper">
  <div class="navbar-container main-menu-content" data-menu="menu-container">
    <ul class="nav navbar-nav" id="main-menu-navigation" data-menu="menu-navigation">
      <li class="nav-item">
        <a class="nav-link" href="{{ url('/') }}"><i class="la la-home"></i>
          <span>Home</span>
        </a>
      </li>
      <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="
ft-info"></i><span>Profile</span></a>
        <ul class="dropdown-menu">
          <li class="">
            <a class="dropdown-item" href="{{ url('/profile/sejarah') }}">Sejarah</a>
          </li>
          <li class="">
            <a class="dropdown-item" href="{{ url('/profile/visi-misi') }}">Visi Misi</a>
          </li>
          <li class="">
            <a class="dropdown-item" href="{{ url('/profile/indikator-mutu') }}">Indikator Mutu</a>
          </li>
          <li class="">
            <a class="dropdown-item" href="{{ url('/profile/kontak-kami') }}">Kontak Kami</a>
          </li>
        </ul>
      </li>
      <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="ft-grid"></i><span>Fasilitas & Layanan</span></a>
        <ul class="dropdown-menu">
          <li class="">
            <a class="dropdown-item" href="{{ url('/') }}">Fasilitas</a>
          </li>
          <li class="">
            <a class="dropdown-item" href="{{ url('/layanan') }}">Layanan</a>
          </li>
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ url('/blog') }}"><i class="ft-clipboard"></i>
          <span>Pendaftaran Online</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ url('/blog') }}"><i class="la la-newspaper-o"></i>
          <span>Blog</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ url('/galeri') }}"><i class="ft-image"></i>
          <span>Galeri</span>
        </a>
      </li>

    </ul>
  </div>
</div>
