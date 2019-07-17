@extends('layouts.visitor.main')
@section('content')
  @component('components.blog.tile') @endcomponent

  @component('components.tabs') @endcomponent

  <div class="blog card">
    <div class="card-content">
      <div class="card-body">
        @component('components.blog.list') @endcomponent
      </div>
    </div>
    <div class="card-footer">
      <nav class="blog__pagination" aria-label="Page navigation">
          <ul class="pagination pagination-separate pagination-round pagination-flat">
              <li class="page-item">
                  <a class="page-link" href="#" aria-label="Previous">
                      <span aria-hidden="true">« Prev</span>
                      <span class="sr-only">Previous</span>
                  </a>
              </li>
              <li class="page-item"><a class="page-link" href="#">1</a></li>
              <li class="page-item"><a class="page-link" href="#">2</a></li>
              <li class="page-item active"><a class="page-link" href="#">3</a></li>
              <li class="page-item"><a class="page-link" href="#">4</a></li>
              <li class="page-item"><a class="page-link" href="#">5</a></li>
              <li class="page-item">
                  <a class="page-link" href="#" aria-label="Next">
                      <span aria-hidden="true">Next »</span>
                      <span class="sr-only">Next</span>
                  </a>
              </li>
          </ul>
      </nav>
    </div>
  </div>
@endsection
@section('footer')
  @include('layouts.visitor.footer-complete')
  @parent
@endsection
