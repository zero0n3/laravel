<div class="form-group">
    <label for="">Thumbnail</label>
    <input type="file" name="album_thumb" id="album_thumb" value="{{$album->album_name}}" class="form-control" placeh
    older="Album name">
</div>

@if($album->album_thumb)
<div class="form-group">
    <img width="150" src="{{asset($album->path)}}" alt="{{$album->album_name}}" title="{{$album->album_name}}">
</div>
@endif
