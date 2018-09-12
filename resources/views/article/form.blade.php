<div class="form-group">
 <div class="input-group">
  <span id="title" class="input-group-text" style="width: 10%;">Title:</span>
  <input id="title" class="form-control"
    <?php if ($btntxt != "Search")
     {
       echo 'placeholder="Title" required ';
       echo "value=\"" . (isset($article->title)?$article->title:'') . "\"";
     } else {
       echo "value=\"" . $search['title'] . "\"";
     } ?>
    name="title" type="text" >
 </div>

 <div class="input-group">
  <span for="body" class="input-group-text" style="width: 10%;">Body:</span>
  <textarea id="body" class="form-control"
    <?php if ($btntxt != "Search")
     { echo 'placeholder="Body" required ';
       echo " rows=\"10\" ";
     } else {
       echo " rows=\"1\" ";
     } ?>
    name="body" type="text" 
  >{{isset($article->body)?$article->body:''}}{{isset($search['body'])?$search['body']:''}}</textarea>
 </div>

 <input id="sbmbtn" class="{{isset($classv)?$classv:"btn btn-sm btn-primary"}}" type="submit" value="{{isset($btntxt)?$btntxt:"Submit"}}">
</div>
