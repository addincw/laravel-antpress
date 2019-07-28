@extends('layouts.visitor.main')
@section('content')
  @component('components.blog.tile', ['blogs' => $blogTiles, 'route' => $route]) @endcomponent

  @component('components.tabs', ['tabs' => $blogCategories, 'selectedTab' => $selectedCategory]) @endcomponent

  <div class="blog card">
    <div class="card-content">
      <div class="card-body">
        @component('components.blog.list', ['blogs' => $blogs, 'route' => $route]) @endcomponent
      </div>
    </div>
    <div class="card-footer">
      {!! $blogs->appends(['category_id' => $selectedCategory])->links() !!}
    </div>
  </div>
@endsection
@section('footer')
  @include('layouts.visitor.footer-complete')
  @parent
@endsection
