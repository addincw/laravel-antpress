<section class="blog-tile">
  @if(!$blogs->isEmpty())
  <div class="row">
    @if(!empty($blogs[0]))
    <div class="col-md-6">
      <!-- Social Card -->
      <div class="blog-tile__main card text-white">
        <div class="blog-tile__main__thumbnail">
          <img src="{{ $blogs[0]->thumbnail_url }}" alt="{{ $blogs[0]->slug }}" class=" card-img-top img-fluid" width="100%">
        </div>
        <div class="blog-tile__main__overlay card-img-overlay">
          <div class="badge badge-danger badge-sm float-left">{{ $blogs[0]->category->title }}</div>
          <span class="text-white float-right font-small-1">{{ $blogs[0]->created_at->format('d M, Y') }}</span>
          <a href="{{ url($route . '/' . $blogs[0]->slug) }}">
            <h2 class="mt-3 text-white" style="font-weight: bold;">{{ $blogs[0]->title }}</h2>
          </a>
          <p class="font-small-3 text-left">
            {!! html_entity_decode(str_limit(strip_tags($blogs[0]->description), 50)) !!}
            @if (strlen(strip_tags($blogs[0]->description)) > 50)
              ...
            @endif
          </p>
        </div>
      </div>
    </div>
    @endif
    <div class="col-md-6">
      <div class="row match-height">
        @if(!empty($blogs[1]))
        <div class="col-xl-6 col-lg-6 col-md-6">

          <div class="card" style="height: 100%;">
            <div style="height: 300px; overflow: hidden;">
              <img src="{{ $blogs[1]->thumbnail_url }}" alt="{{ $blogs[1]->slug }}" class="card-img-top img-fluid" style="height: 100%;">
            </div>
            <div class="card-body">
              <div class="badge badge-success badge-sm float-left">{{ $blogs[1]->category->title }}</div>
              <br>
              <a href="{{ url($route . '/' . $blogs[1]->slug) }}" class="text-dark">
                <p class="card-title mt-1" style="font-weight: bold;">
                  {{ $blogs[1]->title }}
                </p>
              </a>
              <div class="text-muted">
                <p class="float-left text-muted font-small-1">{{ $blogs[1]->created_at->format('d M, Y') }}</p>
              </div>
            </div>
          </div>

        </div>
        @endif
        @if(!empty($blogs[2]))
        <div class="col-xl-6 col-lg-6 col-md-6">

          <div class="card" style="height: 100%;">
            <a href="#"><img src="{{ $blogs[2]->thumbnail_url }}" alt="{{ $blogs[2]->slug }}" class="card-img-top img-fluid"></a>
            <div class="card-body">
              <div class="badge badge-success badge-sm float-left">{{ $blogs[2]->category->title }}</div>
              <br>
              <a href="{{ url($route . '/' . $blogs[2]->slug) }}" class="text-dark">
                <p class="card-title mt-1" style="font-weight: bold;">
                  {{ $blogs[2]->title }}
                </p>
              </a>
              <div class="text-muted">
                <p class="float-left text-muted font-small-1">{{ $blogs[2]->created_at->format('d M, Y') }}</p>
              </div>
            </div>
          </div>

        </div>
        @endif
      </div>
    </div>
  </div>
  @else
  <div class="row">
    <div class="col-12 text-center">
      <p>Tidak ada berita...</p>
    </div>
  </div>
  @endif
</section>
