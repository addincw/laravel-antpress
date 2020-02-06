<?php $criticSuggestion = !empty($criticSuggestion) ? $criticSuggestion : NUll; ?>
<div class="form-body">
  <div class="row">
		<div class="col-md-3">
		</div>
		<div class="col-md-9">
      <div class="form-group">
        <label for="fieldName">Name</label>
        <div class="position-relative has-icon-left">
          <input type="text" id="fieldName" class="form-control" placeholder="Nama Pemberi kritik dan saran" name="name" value="{{ $criticSuggestion ? $criticSuggestion->name : '' }}">
          <div class="form-control-position">
            <i class="ft-user"></i>
          </div>
        </div>
      </div>
      <div class="form-group">
        <label for="fieldName">Email</label>
        <div class="position-relative has-icon-left">
          <input type="email" id="fieldFrom" class="form-control" placeholder="Asal Instansi" name="email" value="{{ $criticSuggestion ? $criticSuggestion->email : '' }}">
          <div class="form-control-position">
            <i class="ft-briefcase"></i>
          </div>
        </div>
      </div>
      <div class="form-group">
        <label for="fieldDescription">Kritik dan Saran</label>
        <div class="position-relative has-icon-left">
          <textarea id="fieldDescription" rows="5" class="form-control" name="critic_suggestion" placeholder="Isi kritik dan saran">@if($criticSuggestion) {{ $criticSuggestion->body }} @endif</textarea>
          <div class="form-control-position">
            <i class="ft-file"></i>
          </div>
        </div>
      </div>
		</div>
	</div>

</div>
