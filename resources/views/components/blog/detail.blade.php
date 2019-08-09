<div class="blog-detail row">
  <div class="col-md-8">
    <div class="header-section mb-3">
      <p class="header-section__title"> {{ $content->title }} </p>
    </div>

    <div class="card">
      <div class="card-content">
        <div class="blog-detail__thumbnail">
          <img class="card-image img-fluid" src="{{ $content->thumbnail_url }}" width="100%" alt="image-{{ $content->slug }}">
        </div>
        <div class="card-body">
          {!! html_entity_decode($content->description) !!}
        </div>
      </div>
    </div>

    <div class="header-section mb-3">
      <p class="header-section__title"> Komentar ({{ count($content->comments) }}) </p>

      <button type="button" class="pull-right btn btn-primary box-shadow-1 text-white" data-toggle="modal" data-target="#modalComment">
        Beri Komentar
        <i class="ft-navigation ml-3"></i>
      </button>
    </div>

    <div class="card">
      <div class="card-content">
        <div class="card-body">
          @if(!empty($content->comments))
            @foreach($content->comments as $comment)
            <div class="media-list media-bordered">
							<div class="media" style="margin-bottom: 15px;">
								<span class="media-left">
									<img class="media-object" src="{{ asset('theme/modern-admin-1.0/app-assets/images/portrait/small/avatar-s-1.png') }}" alt="Generic placeholder image" style="width: 64px;height: 64px;">
								</span>
								<div class="media-body">
									<h5 class="media-heading mb-0 text-bold-600">
											{{ $comment->name }}
									</h5>
									<div class="media-notation mb-1">
										{{ $comment->created_at->format('d M, Y') }}
									</div>
									{{ $comment->body }}
								</div>
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
        <div class="blog-detail__author card-body pt-0">
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
          @component('components.blog.list', ['noThumbnail' => true, 'blogs' => $blogs, 'route' => $route]) @endcomponent
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

<div class="modal fade text-left" id="modalComment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel1">Form Komentar</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="form" action="{{ url($route . '/' . $content->slug . '/comment') }}" method="post">
          {{ csrf_field() }}

          <div class="form-group">
            <label for="fieldName">Name</label>
            <div class="position-relative has-icon-left">
              <input type="text" id="fieldName" class="form-control" placeholder="Nama Anda" name="name">
              <div class="form-control-position">
                <i class="ft-user"></i>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label for="fieldName">Email</label>
            <div class="position-relative has-icon-left">
              <input type="email" id="fieldEmail" class="form-control" placeholder="Email Anda" name="email">
              <div class="form-control-position">
                <i class="ft-mail"></i>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label for="fieldDescription">Isi Komentar</label>
            <div class="position-relative has-icon-left">
              <textarea id="fieldBody" rows="5" class="form-control" name="body" placeholder="Isi Komentar"></textarea>
              <div class="form-control-position">
                <i class="ft-message-circle"></i>
              </div>
            </div>
          </div>

      </div>
      <div class="modal-footer">
          <button type="button" class="btn grey btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success">Kirim komentar</button>
        </form>
      </div>
    </div>
  </div>
</div>
