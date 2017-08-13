@extends('template.default');

@section('content')

  <h2>ALBUMS</h2>
  <ul>
    @foreach ($albums as $album)

      <li>{{$person['name']}}   {{$person['lastname']}} </li>

    @endforeach
</ul>

@endsection
