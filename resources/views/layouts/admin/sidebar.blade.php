<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
  <div class="main-menu-content">
    <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
      <li class="nav-item">
        <a href="index.html">
          <i class="la la-home"></i>
          <span class="menu-title">Dashboard</span>
          <span class="badge badge badge-info badge-pill float-right mr-2">3</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ url('admin/dokter') }}">
          <i class="ft-user-plus"></i>
          <span class="menu-title">Dokter</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ url('admin/klinik') }}">
          <i class="ft-plus-square"></i>
          <span class="menu-title">Klinik</span>
        </a>
      </li>
      <li class=" navigation-header">
        <span>Konten</span>
      </li>
      <li class=" nav-item">
        <a href="{{ url('admin/konten/kategori') }}">
          <i class="ft-list"></i>
          <span class="menu-title">Kategori</span>
        </a>
      </li>
      <li class=" nav-item">
        <a href="{{ url('admin/konten/konten') }}">
          <i class="ft-file-text"></i>
          <span class="menu-title">Konten</span>
        </a>
      </li>
      <li class=" nav-item">
        <a href="{{ url('admin/konten/konten?type=blog') }}">
          <i class="la la-newspaper-o"></i>
          <span class="menu-title">Blog</span>
        </a>
      </li>
      <li class=" nav-item">
        <a href="{{ url('admin/konten/galeri') }}">
          <i class="ft-image"></i>
          <span class="menu-title">Galeri</span>
        </a>
      </li>
      <li class=" navigation-header">
        <span>Profile</span>
      </li>
      <li class=" nav-item">
        <a href="{{ url('admin/profile/testimoni') }}">
          <i class="ft-message-circle"></i>
          <span class="menu-title">Testimoni</span>
        </a>
      </li>
      <li class=" nav-item">
        <a href="{{ url('admin/profile/faq') }}">
          <i class="ft-help-circle"></i>
          <span class="menu-title">FAQ</span>
        </a>
      </li>
      <li class=" nav-item">
        <a href="{{ url('admin/profile/kontak') }}">
          <i class="ft-phone"></i>
          <span class="menu-title">Kontak</span>
        </a>
      </li>
    </ul>
  </div>
</div>
