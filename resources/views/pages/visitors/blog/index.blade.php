@extends('layouts.visitor.main')
@section('content')
  @component('components.blog.tile', ['blogs' => $blogTiles, 'route' => $route]) @endcomponent

  @component('components.tabs', ['tabs' => $blogCategories, 'selectedTab' => $selectedCategory]) @endcomponent

  <div class="blog card">
    <div class="card-content">
      <div class="card-body">
        <div class="form-group mt-3 mb-0">
          <label for="">Cari Berita</label>
          <select class="select2 form-control form-control-xl input xl" name="content_id">
            @if(!empty($selectedContent))
            <option value="{{ $selectedContent->id }}" selected="selected">{{ $selectedContent->title }}</option>
            @endif
          </select>
        </div>

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

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('theme/modern-admin-1.0/app-assets/vendors/css/forms/selects/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('theme/modern-admin-1.0/app-assets/css/pages/search.css') }}">
@endsection

@section('js')
<script src="{{ asset('theme/modern-admin-1.0/app-assets/vendors/js/forms/select/select2.full.min.js') }}" type="text/javascript"></script>
<script type="text/javascript">
var baseUrl = "{{ url('/') }}";
var currentUrl = "{{ url($route) }}";

$("select[name='content_id']").select2({
  ajax: {
    url: `${baseUrl}/api/content/all`,
    data: function (params) {
      var query = { searchKey: params.term }
      return query;
    },
    processResults: function (data) {
      return {
        results: data.results.map((content) => {
          content.text = content.title
          return content
        })
      }
    },

  }
})

$("select[name='content_id']").on('change', function () {
  let query = {
    "category": "{{ $selectedCategory }}",
    "content_id": $(this).val()
  }

  window.location.href = `${currentUrl}?${$.param(query)}`
})
</script>
@endsection
