<?php $faq = !empty($faq) ? $faq : NUll; ?>
<div class="form-body">
  <div class="form-group">
    <label for="fieldQuestion">Question</label>
    <div class="position-relative has-icon-left">
      <input type="text" id="fieldQuestion" class="form-control" placeholder="Pertanyaan" name="question" value="{{ $faq ? $faq->question : '' }}">
      <div class="form-control-position">
        <i class="ft-help-circle"></i>
      </div>
    </div>
  </div>
  <div class="form-group">
    <label for="fieldAnswer">Answer</label>
    <textarea id="fieldAnswer" name="answer">@if($faq) {{ html_entity_decode($faq->answer) }} @endif</textarea>
  </div>

</div>

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('theme/modern-admin-1.0/app-assets/vendors/css/editors/summernote.css') }}">
@endsection

@section('js')
<script src="{{ asset('theme/modern-admin-1.0/app-assets/vendors/js/forms/select/select2.full.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('theme/modern-admin-1.0/app-assets/vendors/js/forms/toggle/switchery.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('theme/modern-admin-1.0/app-assets/vendors/js/editors/codemirror/lib/codemirror.js') }}"
type="text/javascript"></script>
<script src="{{ asset('theme/modern-admin-1.0/app-assets/vendors/js/editors/codemirror/mode/xml/xml.js') }}" type="text/javascript"></script>
<script src="{{ asset('theme/modern-admin-1.0/app-assets/vendors/js/editors/summernote/summernote.js') }}" type="text/javascript"></script>

<script type="text/javascript">
var baseUrl = "{{ url('/') }}"

$(document).ready(function () {
  $('#fieldAnswer').summernote();
})
</script>
@endsection
