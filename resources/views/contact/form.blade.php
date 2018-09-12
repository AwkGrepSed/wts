<div class="form-group">
 <div class="input-group">
  <span id="company" class="input-group-text" style="width: 10%;">Company:</span>
  <input id="company" class="form-control"
    <?php if ($btntxt != "Search")
     {
       echo 'placeholder="Company (optional)" ';
       echo "value=\"" . (isset($contact->company)?$contact->company:'') . "\"";
     } else {
       echo "value=\"" . $search['company'] . "\"";
     } ?>
    name="company" type="text" >
 </div>

 <div class="input-group">
  <span id="person" class="input-group-text" style="width: 10%;">Person:</span>
  <input id="person" class="form-control"
    <?php if ($btntxt != "Search")
     {
       echo 'placeholder="Name" required ';
       echo "value=\"" . (isset($contact->person)?$contact->person:'') . "\"";
     } else {
       echo "value=\"" . $search['person'] . "\"";
     } ?>
    name="person" type="text" >
 </div>

 <div class="input-group">
  <span id="email" class="input-group-text" style="width: 10%;">Email:</span>
  <input id="email" class="form-control"
    <?php if ($btntxt != "Search")
     {
       echo 'placeholder="Email" required ';
       echo "value=\"" . (isset($contact->email)?$contact->email:'') . "\"";
     } else {
       echo "value=\"" . $search['email'] . "\"";
     } ?>
    name="email" type="text" >
 </div>

 <div class="input-group">
  <span id="phone" class="input-group-text" style="width: 10%;">Phone:</span>
  <input id="phone" class="form-control"
    <?php if ($btntxt != "Search")
     {
       echo 'placeholder="Phone (optional)" ';
       echo "value=\"" . (isset($contact->phone)?$contact->phone:'') . "\"";
     } else {
       echo "value=\"" . $search['phone'] . "\"";
     } ?>
    name="phone" type="text" >
 </div>

 <div class="input-group">
  <span id="message" class="input-group-text" style="width: 10%;">Message:</span>
  <textarea id="message" class="form-control"
    <?php if ($btntxt != "Search")
     { echo 'placeholder="Message" required ';
       echo " rows=\"10\" ";
     } else {
       echo " rows=\"1\" ";
     } ?>
    name="message" type="text"
  >{{isset($contact->message)?$contact->message:''}}{{isset($search['message'])?$search['message']:''}}</textarea>
 </div>

 <input id="sbmbtn" class="{{isset($classv)?$classv:"btn btn-sm btn-primary"}}" type="submit" value="{{isset($btntxt)?$btntxt:"Submit"}}">
</div>
