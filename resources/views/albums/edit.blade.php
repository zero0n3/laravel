@extends('templates.default');

@section('content')

  <h2>EDIT FORM</h2>
  <form action="/albums/{{$album->id}}" method="POST" enctype="multipart/form-data">
    {{csrf_field()}}
    <input type="hidden" name="_method" value="PATCH">
      <div class="form-group">
          <label for="">Name</label>
          <input type="text" name="name" id="name" value="{{$album->album_name}}" class="form-control" placeholder="Album name">
      </div>
      <div class="form-group">
          <label for="">Description</label>
          <textarea name="description" id="description" class="form-control" placeholder="Album description">{{$album->description}}</textarea>
      </div>

      <div class="form-group">
          <label for="">Thumbnail</label>
          <input type="file" name="album_thumb" id="album_thumb" value="{{$album->album_name}}" class="form-control" placeholder="Album name">
      </div>

      @if($album->album_thumb)
      <div class="form-group">
          <img src="{{$album->album_thumb}}" alt="{{$album->album_name}}" title="{{$album->album_name}}">
      </div>
      @endif
      <button type="submit" class="btn btn-primary">Submit</button>
  </form>


@endsection
