@extends('templates.default')

@section('content')

  <h2>
    @if($photo->id)
      UPDATE IMAGE
    @else
      NEW IMAGE
    @endif
  </h2>


  @if($photo->id)
    <form action="{{route('photos.update', $photo->id)}}" method="POST" enctype="multipart/form-data">
    {{method_field('PATCH')}}
  @else
    <form action="{{route('photos.store')}}" method="POST" enctype="multipart/form-data">
  @endif
      <div class="form-group">
          <label for="">Name</label>
          <input type="text" name="name" id="name" value="{{$photo->name}}" class="form-control" placeholder="photo name">
      </div>


      <div class="form-group">
        <select required name="album_id" id="album_id">

            <option value="">SELECT</option>

              @foreach($albums as $item)
                <option {{$item->id==$album->id?'selected' :''}} value="{{$item->id}}">{{$item->album_name}}</option>
              @endforeach

        </select>


      </div>

      {{csrf_field()}}
      @include('images.partials.fileupload')

      <div class="form-group">
          <label for="">Description</label>
          <textarea name="description" id="description" class="form-control" placeholder="photo description">{{$photo->description}}</textarea>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
  </form>


@endsection
