<?php $debitur = !empty($debitur) ? $debitur : NUll; ?>
<div class="form-body">
  <div class="form-group">
    <label for="fieldName">Name</label>
    <div class="position-relative has-icon-left">
      <input type="text" id="fieldName" class="form-control" placeholder="Nama Debitur" name="name" value="{{ $debitur ? $debitur->name : '' }}">
      <div class="form-control-position">
        <i class="ft-help-circle"></i>
      </div>
    </div>
  </div>
  <div class="form-group">
    <label for="fieldDescription">Description</label>
    <textarea id="fieldDescription" class="form-control" name="description">@if($debitur) {{ html_entity_decode($debitur->description) }} @endif</textarea>
  </div>

</div>