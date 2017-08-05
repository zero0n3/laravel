@extends('templates.default')
@section('title', $title)

@section('content')
  <h1>
    {{$title}}
  </h1>



  @if($staff)

    <ul>

    @foreach ($staff as $person)

      <li>{{$person['name']}}   {{$person['lastname']}} </li>

    @endforeach

    </ul>
  @else
     <p>no staff</p>

  @endif



    <ul>
@forelse ($staff as $person)
  <li>{{$person['name']}}   {{$person['lastname']}} </li>
@empty
  <li>no staff</li>
@endforelse
</ul>



@endsection
