@extends('frontsite.layout.main')

@section('content')
<!-- Carousel -->
<section class="banner">
  @component('components.carousel', [
    'banners' => $banners
  ]) @endcomponent
</section>
<!--/ Carousel -->

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
            <h2 class="card-title mt-2 text-white">Lorem ipsum dolor sit amet consectetur</h2>
            <p class="card-text">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ad quod aliquid sint nostrum. Saepe consequatur soluta laudantium libero ipsam odit quam dolore, excepturi voluptate culpa. Sequi eius error distinctio voluptas?</p>
            <button class="btn btn-primary btn-darken-3">Lorem ipsum</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- /registration -->

<!-- news -->
<div class="header-section mt-3">
  <p class="header-section__title"> Berita & Info </p>
  <a href="{{ url('/blog') }}" class="float-right btn btn-primary box-shadow-1 text-white"> lebih banyak</a>
</div>

@component('components.blog.tile', [
'blogs' => $blogs,
'route' => url($route) . '/blog'
]) @endcomponent

<!-- Description -->
<section class="about">
  <div class="row">
    <div class="col-md-12">
      <section class="video">
        @if(!empty($video))
          <iframe class="video__content" width="100%" height="600" src="{{ $video->file }}"> </iframe>
        @endif
      </section>
    </div>
  </div>

</section>
<!--/ Description -->
@endsection

@section('footer')
  <div class="row wrapper mb-5">
    <div class="col-md-6">
      <div class="header-section">
        <p class="header-section__title"> FAQ </p>
      </div>

      <div class="card">
				<div class="card-content">
					<div id="accordionWrap1" role="tablist" aria-multiselectable="true">
						<div class="card collapse-icon panel mb-0 box-shadow-0 border-0">

              @foreach($faqs as $key => $faq)
							<div id="heading{{$key}}" role="tab" class="card-header border-bottom-blue-grey border-bottom-lighten-4">
								<a data-toggle="collapse" data-parent="#accordionWrap1" href="#accordion{{$key}}" aria-expanded="false" aria-controls="accordion{{$key}}" class="h6 blue collapsed">
                  {{ $faq->question }}
                </a>
							</div>
							<div id="accordion{{$key}}" role="tabpanel" aria-labelledby="heading{{$key}}" class="collapse" aria-expanded="true" style="">
								<div class="card-body">
                  {!! html_entity_decode(str_limit(strip_tags($faq->answer), 150)) !!}
                  @if (strlen(strip_tags($faq->answer)) > 150)
                  ...
                  <a href="{{ url('/faq/' . $faq->id) }}">read more</a>
                  @endif
								</div>
							</div>
              @endforeach

						</div>
					</div>
				</div>
			</div>
    </div>

    <div class="col-md-6">
        <div class="header-section">
        <p class="header-section__title"> 
          <i class="ft-mail"></i> Kritik & Saran 
        </p>
      </div>

      <form method="POST" action="{{ url('kritik-saran') }}">
        @csrf

        <div class="form-group">
          <label for="userinput5">Email</label>
          <input class="form-control border-primary" type="email" placeholder="email" name="email">
        </div>

        <div class="form-group">
          <label for="userinput5">Name</label>
          <input class="form-control border-primary" type="name" placeholder="name" name="name">
        </div>

        <div class="form-group">
          <label for="userinput8">Kritik & Saran</label>
          <textarea id="userinput8" rows="5" class="form-control border-primary" name="critic_suggestion" placeholder="Kritik & Saran"></textarea>
        </div>

        <div class="form-actions text-right">
          <button type="submit" class="btn btn-primary">
            <i class="la la-check-square-o"></i> Save
          </button>
        </div>
      </form>
    </div>
  </div>

  <div class="row wrapper mb-5">
    <div class="col-12">
      @component('components.testimoni', [
        'testimonies' => $testimonies
      ]) @endcomponent
    </div>
  </div>

  @component('frontsite.layout.footer', [
    'profile' => $profile,
    'recentGalleries' => $recentGalleries
  ]) @endcomponent
  @parent
@endsection
