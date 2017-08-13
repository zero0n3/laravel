@extends('templates.default');

@section('content')

  <h2>ALBUMS</h2>
  <ul class="list-group">
    @foreach ($albums as $album)

      <li class="list-group-item justify-content-between">
            {{$album->album_name}}
            <a href="/albums/{{$album->id}}/delete" class="btn btn-danger">   DELETE</a>
      </li>

    @endforeach

  </ul>

@endsection
