@extends('layouts.visitor.main')

@section('content')
<!-- Carousel -->
<section class="banner">
  @component('components.carousel', [
    'banners' => $banners
  ]) @endcomponent
</section>
<!--/ Carousel -->

<!-- Description -->
<div class="header-section">
  <p class="header-section__title"> Tentang Kami </p>
</div>

<section class="about">
  <div class="row">
    <div class="col-md-8">
      <div class="card">
        <div class="card-content">
          <div class="card-body">
            <div class="card-text">
              <p>
                {!! html_entity_decode(str_limit(strip_tags($aboutUs->description), 640)) !!}
                @if (strlen(strip_tags($aboutUs->description)) > 500)
                ...
                @endif
              </p>
            </div>
            <a href="{{ url('/profile/sejarah') }}" class="btn btn-primary btn-min-width box-shadow-1 mt-3 mb-2">Read More</a>
          </div>
        </div>
        <div class="card-footer">
          <a class="btn btn-pure" href="{{ url('/profile/visi-misi') }}">Visi Misi</a>
          <a class="btn btn-pure" href="{{ url('/profile/indikator-mutu') }}">Indikator Mutu</a>
          <a class="btn btn-pure" href="{{ url('/profile/kontak-kami') }}">Kontak Kami</a>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <!-- count doctor -->
      <div class="card pull-up">
        <div class="card-content">
          <div class="card-body">
            <div class="media d-flex">
              <div class="media-body text-left">
                <h6 class="text-muted">Dokter</h6>
                <h3>{{ $countDoctor }}</h3>
              </div>
              <div class="align-self-center">
                <i class="ft-users primary font-large-2 float-right"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- count clinic -->
      <div class="card pull-up">
        <div class="card-content">
          <div class="card-body">
            <div class="media d-flex">
              <div class="media-body text-left">
                <h6 class="text-muted">Klinik</h6>
                <h3>{{ $countClinic }}</h3>
              </div>
              <div class="align-self-center">
                <i class="ft-clipboard danger font-large-2 float-right"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- count -->
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
<section class="registration registration--outwrapper mt-2">
  <div class="card text-white bg-primary">
    <div class="card-content">
      <div class="card-body pt-3">
        <div class="row">
          <div class="col-5 registration__thumbnail">
            <img src="{{ asset('img/registration-online.png') }}" alt="registration-online">
          </div>
          <div class="col-md-7 registration__desc">
            <h2 class="card-title mt-2 text-white">Daftar Online</h2>
            <p class="card-text">Kini mau kontrol / konsultasi ke dokter bisa daftar secara online, tidak perlu daftar ke tempat.</p>
            <button class="btn btn-primary btn-darken-3">Daftar Sekarang</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- /registration -->

<!-- news -->
<div class="header-section mt-3">
  <p class="header-section__title"> Berita & Info Kesehatan </p>
  <a href="{{ url('/blog') }}" class="float-right btn btn-primary box-shadow-1 text-white">Tampilkan lebih banyak</a>
</div>

@component('components.blog.tile', [
'blogs' => $blogs,
'route' => url($route) . '/blog'
]) @endcomponent

<!-- events -->
<div class="header-section">
  <p class="header-section__title"> Dokter Kami </p>
  <a href="{{ url('/dokter') }}" class="float-right btn btn-primary box-shadow-1 text-white">Tampilkan lebih banyak</a>
</div>

@component('components.carousel-doctor', [
'doctors' => $doctors
]) @endcomponent

@endsection

@section('footer')
  @component('components.testimoni', [
    'testimonies' => $testimonies
  ]) @endcomponent

  @component('layouts.visitor.footer-complete', [
    'profile' => $profile,
    'recentGalleries' => $recentGalleries
  ]) @endcomponent
  @parent
@endsection
