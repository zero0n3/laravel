<div class="form-group">
    <label for="">Thumbnail</label>
    <input type="file" name="img_path" id="img_path" value="{{$photo->img_path}}" class="form-control">
</div>

@if($photo->img_path)
<div class="form-group">
    <img width="150" src="{{asset($photo->img_path)}}" alt="{{$photo->img_path}}" title="{{$photo->img_path}}">
</div>
@endif
