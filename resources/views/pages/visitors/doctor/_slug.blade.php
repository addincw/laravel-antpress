@extends('layouts.visitor.main')

@section('content')
<section id="doctor-profile">
  <div class="row match-height">
    <div class="col-lg-3">
      <div class="card">
        <div class="card-header text-center">
          <img src="{{ $doctor->image_url }}" alt="" class="card-img-top mb-1 img-fluid w-50 rounded-circle">
          <h1 class="card-title mb-1">{{ $doctor->name }}</h1>
          <h6 class="text-light">{{ $doctor->specialist }}</h6>
        </div>
        <ul class="list-group list-group-flush">
          <!-- clinics -->
          @if($doctor->clinics->count() < 0)
          <li class="list-group-item">
            tidak terdaftar di klinik manapun.
          </li>
          @endif
          @foreach($doctor->clinics as $clinic)
          <li class="list-group-item">
            <div class="row">
              <div class="col-1">
                <i class="ft-briefcase"></i>
              </div>
              <div class="col">
                {{ $clinic->clinic->title }}
                <br>
                <span class="text-light">senin, rabu, jumat</span>
                <br>
                <span class="text-light">12.00 - 12.00</span>
              </div>
            </div>
          </li>
          @endforeach

          <li class="list-group-item">
            @if($doctor->is_active)
            <span class="badge bg-success float-right">aktif</span>
            @else
            <span class="badge bg-danger float-right">tidak aktif</span>
            @endif
            Status Keaktifan
          </li>
        </ul>
      </div>
    </div>
    <div class="col-lg-9">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title"><i class="ft-calendar mr-1"></i> Jadwal Praktik</h4>
        </div>
        <div class="card-body">
          <p class="card-text">Select Date From calender to book an appointment</p>

          <div id="clndr-default" class="overflow-hidden bg-grey bg-lighten-3"></div>

        </div>
        <!-- <div class="card-footer">
          <button class="btn btn-danger float-right">Book Appointment</button>
        </div> -->
      </div>
    </div>

  </div>
</section>

<div id="clndr" class="clearfix">
  <script type="text/template" id="clndr-template">
    <div class="clndr-controls">
      <div class="clndr-previous-button">&lt;</div>
      <div class="clndr-next-button">&gt;</div>
      <div class="current-month">
        <%= month %>
        <%= year %>
      </div>
    </div>
    <div class="clndr-grid">
      <div class="days-of-the-week clearfix">
        <% _.each(daysOfTheWeek, function(day) { %>
          <div class="header-day">
            <%= day %>
          </div>
        <% }); %>
      </div>
      <div class="days">
        <% _.each(days, function(day) { %>
          <div class="<%= day.classes %>" id="<%= day.id %>">
            <span class="day-number">
              <%= day.day %>
            </span>
          </div>
        <% }); %>
      </div>
    </div>
    <div class="event-listing">
      <div class="event-listing-title" style="padding: 15px;">Event this month</div>
      <% _.each(eventsThisMonth, function(event) { %>
        <div class="event-item font-small-3">
          <div class="event-item-day font-small-2">
            <%= event.date %>
          </div>
          <div class="event-item-name text-bold-600">
            <%= event.title %>
          </div>
          <div class="event-item-location">
            <%= event.location %>
          </div>
        </div>
      <% }); %>
    </div>
  </script>
</div>
@endsection

@section('footer')
  @include('layouts.visitor.footer-complete')
  @parent
@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('theme/modern-admin-1.0/app-assets/css/plugins/calendars/clndr.css') }}">
@endsection

@section('js')
<script src="{{ asset('theme/modern-admin-1.0/app-assets/vendors/js/extensions/moment.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('theme/modern-admin-1.0/app-assets/vendors/js/extensions/underscore-min.js') }}" type="text/javascript"></script>
<script src="{{ asset('theme/modern-admin-1.0/app-assets/vendors/js/extensions/clndr.min.js') }}" type="text/javascript"></script>

<script type="text/javascript">
$('#clndr-default').clndr({
  template: $('#clndr-template').html(),
  events: [],
});
</script>
@endsection
