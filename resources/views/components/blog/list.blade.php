<?php $noThumbnail = !empty($noThumbnail) ? $noThumbnail : false; ?>
<?php $blogs = !empty($blogs) ? $blogs : false; ?>
<ul class="blog__media-list media-list media-bordered">
  @if($blogs->isEmpty())
  <li class="media">Tidak ada berita...</li>
  @else
    @foreach($blogs as $blog)
    <li class="media" style="margin-bottom: 15px;">
      @if(!$noThumbnail)
      <div class="media-left">
        <a href="#">
          <img class="media-object width-150" src="{{ $blog->thumbnail_url }}" alt="Generic placeholder image">
        </a>
      </div>
      @endif
      <div class="media-body media-search">
        <div class="badge badge-success badge-sm">{{ $blog->category->title }}</div>
        <p class="lead mb-0 mt-1">
          <a href="{{ url($route . '/' . $blog->slug) }}"><span class="text-bold-600">{{ $blog->title }}</a>
        </p>
        <p>
          <span class="text-muted">{{ $blog->created_at->format('d M, Y') }} - </span>
          {{ str_limit(strip_tags($blog->description), 50) }}
          @if (strlen(strip_tags($blog->description)) > 50)
            ...
          @endif
        </p>
        <div class="media-body__meta">
          <div class="media-body__meta__creator">
            <div class="mr-1">
              <img src="{{ asset('theme/modern-admin-1.0/app-assets/images/portrait/medium/avatar-m-8.png') }}" alt="" class="avatar avatar-xs">
            </div>
            <div>
              <h6 class="m-0">{{ $blog->creator_name }}</h6>
            </div>
          </div>

          <span class="pr-1"><i class="ft-message-square h4 align-middle"></i> {{ $blog->comments()->count() }}</span>
        </div>
      </div>
    </li>
    @endforeach
  @endif
</ul>
