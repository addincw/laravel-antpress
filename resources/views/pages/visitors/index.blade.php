@extends('layouts.visitor.main')

@section('content')
<!-- Carousel -->
<div style="height:500px; margin-bottom: 2.2rem">
  @component('components.carousel') @endcomponent
</div>
<!--/ Carousel -->

<!-- Description -->
<section class="about row">
  <div class="col-md-8">
    <div class="about-desc card">
      <div class="card-header">
        <h4 class="card-title">Tentang Kami</h4>
      </div>
      <div class="card-content">
        <div class="card-body">
          <div class="card-text">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident....</p>
          </div>
          <button type="button" class="btn btn-primary btn-min-width box-shadow-1 mt-3 mb-1">Read More</button>
        </div>
      </div>
      <div class="card-footer">
        <a class="btn btn-pure" href="#">Visi Misi</a>
        <a class="btn btn-pure" href="#">Struktur Organisasi</a>
        <a class="btn btn-pure" href="#">Contact Info</a>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="about-in-number">
      <div class="card pull-up">
        <div class="card-content">
          <div class="card-body">
            <div class="media d-flex">
              <div class="media-body text-left">
                <h6 class="text-muted">Dokter</h6>
                <h3>30</h3>
              </div>
              <div class="align-self-center">
                <i class="ft-users primary font-large-2 float-right"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="card pull-up">
        <div class="card-content">
          <div class="card-body">
            <div class="media d-flex">
              <div class="media-body text-left">
                <h6 class="text-muted">Klinik</h6>
                <h3>6</h3>
              </div>
              <div class="align-self-center">
                <i class="ft-clipboard danger font-large-2 float-right"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="card pull-up">
        <div class="card-content">
          <div class="card-body">
            <div class="media d-flex">
              <div class="media-body text-left">
                <h6 class="text-muted">Staff Profesional</h6>
                <h3>100</h3>
              </div>
              <div class="align-self-center">
                <i class="ft-users success font-large-2 float-right"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!--/ Description -->
<!-- registration -->
<div class="row">
  <div class="col-12">
    <div class="card text-white bg-primary" style="overflow: hidden; height: 250px;">
			<div class="card-content">
				<div class="card-body pt-3">
          <div class="row">
            <div class="col-5">
              <img src="{{ asset('theme/modern-admin-1.0/app-assets/images/elements/01.png') }}" alt="element 01" width="190">
            </div>
            <div class="col-7">
              <h2 class="card-title mt-2 text-white">Daftar Online</h2>
              <p class="card-text">Kini mau kontrol / konsultasi ke dokter bisa daftar secara online, tidak perlu daftar ke tempat.</p>
              <button class="btn btn-primary btn-darken-3">Daftar Sekarang</button>
            </div>
          </div>
				</div>
			</div>
		</div>
  </div>
</div>
<!-- /registration -->
<!-- news -->
<h4 class="mt-3 mb-3">Berita & Info Kesehatan <a class="float-right btn btn-primary box-shadow-1 text-white">Tampilkan lebih banyak</a> </h4>
@component('components.blog.tile') @endcomponent
<!-- /news -->
<!-- events -->
<h4 class="mt-3 mb-3">Dokter Kami<a class="float-right btn btn-primary box-shadow-1 text-white">Tampilkan lebih banyak</a> </h4>
@component('components.carousel-doctor') @endcomponent
<!-- /events -->
@endsection
@section('footer')
  @component('components.testimoni') @endcomponent
  @component('layouts.visitor.footer-complete') @endcomponent
  @parent
@endsection
