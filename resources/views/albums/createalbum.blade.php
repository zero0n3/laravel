@extends('templates.default')

@section('content')

  <h2>NEW ALBUM</h2>
  <form action="{{route('album.save')}}" method="POST" enctype="multipart/form-data">
    {{csrf_field()}}

      <div class="form-group">
          <label for="">Name</label>
          <input type="text" name="name" id="name" value="" class="form-control" placeholder="Album name">
      </div>
      @include('albums.partials.fileupload')
      <div class="form-group">
          <label for="">Description</label>
          <textarea name="description" id="description" class="form-control" placeholder="Album description"></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
  </form>


@endsection
