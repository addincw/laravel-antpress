@extends('layouts.visitor.main')

@section('content')
<div class="row">
  <div class="col-md-4 col-12">
    <div class="card" style="margin: 0px">
      <div class="text-center">
          <div class="card-body">
              <img src="{{ asset('theme/modern-admin-1.0/app-assets/images/portrait/medium/avatar-m-4.png') }}" class="rounded-circle  height-150" alt="Card image">
          </div>
          <div class="card-body">
              <h4 class="card-title">Frances Butler</h4>
              <h6 class="card-subtitle text-muted">Technical Lead</h6>
          </div>
      </div>
      <div class="list-group list-group-flush">
          <a href="#" class="list-group-item text-center"><i class="la la-briefcase"></i> Klinik Kecantikan</a>
      </div>
      <div class="card-footer">
        <button class="btn btn-block btn-primary" name="button">Daftar</button>
      </div>
  </div>
  </div>
  <div class="col-md-8 col-12">
    <div class="card" style="height: 100%;">
      <div class="card-header">
        <h1 class="card-title">Jadwal Praktek</h1>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered mb-0">
              <thead>
                  <tr>
                      <th>#</th>
                      <th>First Name</th>
                      <th>Last Name</th>
                      <th>Username</th>
                  </tr>
              </thead>
              <tbody>
                  <tr>
                      <th scope="row">1</th>
                      <td>Mark</td>
                      <td>Otto</td>
                      <td>@mdo</td>
                  </tr>
                  <tr>
                      <th scope="row">2</th>
                      <td>Mark</td>
                      <td>Otto</td>
                      <td>@TwBootstrap</td>
                  </tr>
                  <tr>
                      <th scope="row">3</th>
                      <td>Jacob</td>
                      <td>Thornton</td>
                      <td>@fat</td>
                  </tr>
                  <tr>
                      <th scope="row">4</th>
                      <td colspan="2">Larry the Bird</td>
                      <td>@twitter</td>
                  </tr>
              </tbody>
          </table>
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
