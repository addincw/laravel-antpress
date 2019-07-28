<section class="testimoni">
  <div class="wrapper">
    <div class="row">
      <div class="col-md-12" style="text-align:center;">
        <h3>PESAN DAN KESAN PARA TOKOH</h3>
      </div>
      <div class="col-md-12">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
          <!-- Wrapper for carousel items -->
          @foreach($testimonies as $testimoni)
          <div class="carousel-inner">
            <div class="item carousel-item active">
              <div class="img-box"><img src="{{ $testimoni->thumbnail_url }}" alt="image testimoni {{ $testimoni->name }}"></div>
              <p class="testimonial">{{ $testimoni->body }}</p>
              <p class="overview"><b>{{ $testimoni->name }}</b>, {{ $testimoni->from }}</p>
            </div>
          </div>
          @endforeach
          <!-- Carousel controls -->
          <a class="carousel-control left carousel-control-prev" href="#myCarousel" data-slide="prev">
            <i class="fa fa-angle-left"></i>
          </a>
          <a class="carousel-control right carousel-control-next" href="#myCarousel" data-slide="next">
            <i class="fa fa-angle-right"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
</section>
