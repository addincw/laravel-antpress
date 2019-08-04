<section class="testimoni">
  <div class="wrapper">
    <div class="row">
      <div class="col-md-12" style="text-align:center;">
        <h3>PESAN DAN KESAN PARA TOKOH</h3>
      </div>
      <div class="col-md-12">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
          <!-- Wrapper for carousel items -->
          <div class="carousel-inner">
          <?php $init = 0; ?>
          @foreach($testimonies as $testimoni)
            <div class="item carousel-item @if($init == 0) active @endif">
              <div class="img-box"><img src="{{ $testimoni->thumbnail_url }}" alt="image testimoni {{ $testimoni->name }}"></div>
              <p class="testimonial">{{ $testimoni->body }}</p>
              <p class="overview"><b>{{ $testimoni->name }}</b>, {{ $testimoni->from }}</p>
            </div>
            <?php $init=1; ?>
          @endforeach
          </div>
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
