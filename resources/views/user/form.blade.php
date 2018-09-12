<div class="form-group">
 <div class="input-group">
  <span id="name" class="input-group-text" style="width: 10%;">Name:</span>
  <input id="name" class="form-control"
    <?php if ($btntxt != "Search")
     {
       echo 'placeholder="Name" required ';
       echo "value=\"" . (isset($user->name)?$user->name:old('name')) . "\"";
     } else {
       echo "value=\"" . $search['name'] . "\"";
     } ?>
    name="name" type="text" >
 </div>

 <div class="input-group">
  <span id="email" class="input-group-text" style="width: 10%;">Email:</span>
  <input id="email" class="form-control"
    <?php if ($btntxt != "Search")
     {
       echo 'placeholder="Email" required ';
       echo "value=\"" . (isset($user->email)?$user->email:old('email')) . "\"";
     } else {
       echo "value=\"" . $search['email'] . "\"";
     } ?>
    name="email" type="text" >
 </div>

@if ($btntxt == "Create")
 <div class="input-group">
  <span id="password" class="input-group-text" style="width: 10%;">Password:</span>
  <input id="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
    value="{{ (isset($user->password)?$user->password:old('password')) }}"
    name="password" type="password" required>
 </div>

 <div class="input-group">
  <span id="password-confirm" class="input-group-text" style="width: 10%;">Confirm:</span>
  <input id="password-confirm" class="form-control"
    name="password_confirmation" type="password" required>
 </div>
@endif

 <input id="sbmbtn" class="{{isset($classv)?$classv:"btn btn-sm btn-primary"}}" type="submit" value="{{isset($btntxt)?$btntxt:"Submit"}}">
</div>
