@extends('templates.default')

@section('content')

  <h2>PHOTOS</h2>
  @if (session()->has('message'))
    @component('components.alert-info')
      {{session()->get('message')}}
    @endcomponent
  @endif
<DIV>
  <table class="table table-bordered">
    <tr>
      <th>ID</th>
      <th>CREATE</th>
      <th>TITLE</th>
      <th>ALBUM</th>
      <th>THUMBNAIL</th>
    </tr>
    @forelse ($images as $image)
      <tr>
        <td>{{$image->id}}</td>
        <td>{{$image->created_at}}</td>
        <td>{{$image->name}}</td>
        <td>{{$album->album_name}}</td>
        <td><img src="{{asset($image->img_path)}}" width="35" alt=""></td>
      </tr>
    @empty
      <tr>
        <td colspan="5">no images</td>
      </tr>
    @endforelse
  </table>
</DIV>
@endsection
