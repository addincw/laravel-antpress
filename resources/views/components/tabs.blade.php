<ul class="nav nav-pills mt-3 mb-2">
  @foreach($tabs as $tab)
  <li class="nav-item">
    <a class="nav-link @if($tab->id === $selectedTab) active @endif" id="base-pill1" data-toggle="pill" href="#pill1" aria-expanded="true">{{ $tab->title }}</a>
  </li>
  @endforeach
</ul>
