@extends('layouts.visitor.main')
@section('content')
<div class="row">
  <div class="col-md-8">
    <h1 class="mb-3">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</h1>
    <div class="card">
      <div class="card-content">
        <img class="card-image img-fluid" src="https://placeimg.com/1000/600/tech" alt="">
        <div class="card-body">
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        </div>
      </div>
    </div>

    @component('components.media') @endcomponent

    <h3 class="mt-3 mb-3">Komentar (10)
      <a class="pull-right btn btn-primary box-shadow-1 text-white">
        Beri Komentar
        <i class="ft-navigation ml-3"></i>
      </a>
    </h3>
    <div class="card">
      <div class="card-content">
        <div class="card-body">
          <div class="media">
            <div class="media-left mr-1">
                <a href="#">
                    <span class="avatar avatar-online"><img src="{{ asset('theme/modern-admin-1.0/app-assets/images/portrait/small/avatar-s-1.png') }}" alt="avatar"></span>
                </a>
            </div>
            <div class="media-body">
                <p class="text-bold-600 mb-0"><a href="#">Jason Ansley</a></p>
                <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo.</p>
                <ul class="list-inline">
                    <li class="pr-1"><a href="#" class=""><span class="la la-thumbs-o-up"></span> Like</a></li>
                    <li class="pr-1"><a href="#" class=""><span class="la la-commenting-o"></span> Reply</a></li>
                </ul>
                <div class="media">
                    <div class="media-left mr-1">
                        <a href="#">
                            <span class="avatar avatar-online"><img src="{{ asset('theme/modern-admin-1.0/app-assets/images/portrait/small/avatar-s-18.png') }}" alt="avatar"></span>
                        </a>
                    </div>
                    <div class="media-body">
                        <p class="text-bold-600 mb-0"><a href="#">Janice Johnston</a></p>
                        <p>Gravida nulla. Nulla vel metus scelerisque ante sollicitudin.</p>
                        <ul class="list-inline">
                            <li class="pr-1"><a href="#" class=""><span class="la la-thumbs-o-up"></span> Like</a></li>
                            <li class="pr-1"><a href="#" class=""><span class="la la-commenting-o"></span> Reply</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
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
            <img src="{{ asset('theme/modern-admin-1.0/app-assets/images/portrait/medium/avatar-m-4.png') }}') }}" alt="" class="img-fluid rounded-circle width-50 mr-3">
            <div>
              <h3 class="white">Marina Valentine’s Birthday!</h3>
              <p class="card-text">Some quick example text to build on the card.</p>
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
                  <div class="badge badge-success round">
      						  <i class="la la-file-o font-medium-2"></i>
      							<span>Success Badge</span>
      						</div>
                  <div class="badge badge-success round">
      						  <i class="la la-file-o font-medium-2"></i>
      							<span>Success Badge</span>
      						</div>
                  <div class="badge badge-success round">
      						  <i class="la la-file-o font-medium-2"></i>
      							<span>Success Badge</span>
      						</div>
                </span>
            </div>
        </div>
    </div>
  </div>
</div>
@endsection

@section('footer')
  @include('layouts.visitor.footer-complete')
  @parent
@endsection
