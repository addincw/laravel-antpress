<div class="row">
  <div class="col-md-8">
    <h1 class="mb-3">{{ $content->title }}</h1>
    <div class="card">
      <div class="card-content">
        <img class="card-image img-fluid" src="{{ $content->thumbnail_url }}" alt="image-{{ $content->slug }}">
        <div class="card-body">
          {!! html_entity_decode($content->description) !!}
        </div>
      </div>
    </div>

    <h3 class="mt-3 mb-3">Komentar ({{ count($content->comments) }})
      <a class="pull-right btn btn-primary box-shadow-1 text-white">
        Beri Komentar
        <i class="ft-navigation ml-3"></i>
      </a>
    </h3>
    <div class="card">
      <div class="card-content">
        <div class="card-body">
          @if(!empty($content->comments))
            @foreach($content->comments as $comment)
            <div class="media">
              <div class="media-left mr-1">
                <a href="#">
                  <span class="avatar avatar-online"><img src="{{ asset('theme/modern-admin-1.0/app-assets/images/portrait/small/avatar-s-1.png') }}" alt="avatar"></span>
                </a>
              </div>
              <div class="media-body">
                <p class="text-bold-600 mb-0"><a href="#">Jason Ansley</a></p>
                <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo.</p>
              </div>
            </div>
            @endforeach
          @endif
        </div>
      </div>
    </div>

  </div>
  <div class="col-md-4">
    <!-- creator -->
    <div class="card text-white bg-primary mb-3">
        <div class="card-header">
            <h4 class="text-white"><i class="ft-award white mt-1 mr-1"></i> created by</h4>
        </div>
        <div class="card-body pt-0" style="display: flex; align-items: center;">
            <img src="{{ $content->creator_image_url }}" alt="image {{ $content->creator_name }}" class="img-fluid rounded-circle width-50 mr-3">
            <div>
              <h3 class="white">{{ $content->creator_name }}</h3>
              <p class="card-text">{{ $content->creator_title }}</p>
            </div>
        </div>
    </div>

    <!-- Related Post -->
    <div class="card mt-2">
        <div class="card-header">
          <h5 class="card-title">Related Post</h5>
        </div>
        <div class="card-body p-0">
          @component('components.blog.list', ['noThumbnail' => true]) @endcomponent
        </div>
    </div>

    <!-- tags -->
    <div class="card mt-2">
        <div class="card-body">
            <div class="friends-list">
                <h5 class="card-title mb-1">Tags</h5>
                <hr>
                <span>
                  @if(!empty($content->tags))
                    @foreach($content->tags as $tag)
                    <div class="badge badge-success round">
                      <i class="la la-file-o font-medium-2"></i>
                      <span>{{ $tag->tag->name }}</span>
                    </div>
                    @endforeach
                  @endif
                </span>
            </div>
        </div>
    </div>
  </div>
</div>
