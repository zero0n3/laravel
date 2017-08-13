@extends('templates.default');

@section('content')

  <h2>ALBUMS</h2>
  <ul>
    @foreach ($albums as $album)

      <li>{{$album->album_name}}  </li>

    @endforeach

  </ul>

@endsection
