<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
  <div class="main-menu-content">
    <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
      <li class="nav-item">
        <a href="{{ url('backsite') }}">
          <i class="la la-home"></i>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>
      <li class=" navigation-header">
        <span>Konten</span>
      </li>
      <li class=" nav-item">
        <a href="{{ url('backsite/konten/kategori') }}">
          <i class="ft-list"></i>
          <span class="menu-title">Kategori</span>
        </a>
      </li>
      <li class=" nav-item">
        <a href="{{ url('backsite/konten/konten') }}">
          <i class="ft-file-text"></i>
          <span class="menu-title">Konten</span>
        </a>
      </li>
      <li class=" nav-item">
        <a href="{{ url('backsite/konten/konten?type=blog') }}">
          <i class="la la-newspaper-o"></i>
          <span class="menu-title">Blog</span>
        </a>
      </li>
      <li class=" nav-item">
        <a href="{{ url('backsite/konten/galeri') }}">
          <i class="ft-image"></i>
          <span class="menu-title">Galeri</span>
        </a>
      </li>
      <li class=" navigation-header">
        <span>Kritik dan Saran</span>
      </li>
      <li class="nav-item">
        <a href="{{ url('backsite/kritik-saran') }}">
          <i class="ft-mail"></i>
          <span class="menu-title">Kritik dan Saran</span>
        </a>
      </li>
      <li class=" navigation-header">
        <span>Profile</span>
      </li>
      <li class=" nav-item">
        <a href="{{ url('backsite/profile/testimoni') }}">
          <i class="ft-message-circle"></i>
          <span class="menu-title">Testimoni</span>
        </a>
      </li>
      <li class=" nav-item">
        <a href="{{ url('backsite/profile/faq') }}">
          <i class="ft-help-circle"></i>
          <span class="menu-title">FAQ</span>
        </a>
      </li>
      <li class=" nav-item">
        <a href="{{ url('backsite/profile/profile') }}">
          <i class="ft-phone"></i>
          <span class="menu-title">Kontak</span>
        </a>
      </li>
    </ul>
  </div>
</div>
