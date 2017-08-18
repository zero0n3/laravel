@extends('templates.default')

@section('content')

  <h2>ALBUMS</h2>
  @if (session()->has('message'))
    @component('components.alert-info')
      {{session()->get('message')}}
    @endcomponent
  @endif
  <form>
  <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
  <ul class="list-group">
    @foreach ($albums as $album)

        <li class="list-group-item justify-content-between">({{$album->id}}) {{$album->album_name}}
          @if($album->album_thumb)
            <img width="50" src="{{$album->album_thumb}}" alt="{{$album->album_name}}" title="{{$album->album_name}}">
          @endif
          <div>

            <a href="/albums/{{$album->id}}/edit" class="btn btn-primary">UPDATE</a>
            <a href="/albums/{{$album->id}}" class="btn btn-danger">DELETE</a>
          </div>
        </li>

    @endforeach

  </ul>
</form>
@endsection

@section('footer')
  @parent
    <script>
    $('document').ready(function(){
      $('div.alert').fadeOut(1500);
      $('ul').on('click', 'a.btn-danger', function(ele) {
      //$('#delete').click(function(ele) {
        ele.preventDefault();
        /* Act on the event */
        //console.log(ele);
        var urlAlbum = $(this).attr('href');

        //console.log(myvar);
        //var li = ele.target.parentNode;
        var li = ele.target.parentNode.parentNode;
//console.log(li);
        $.ajax(
          urlAlbum,
          {
            method: 'DELETE',
            data: {
              '_token': $('#_token').val()
            },
            complete : function(resp){
              if (resp.responseText == 1){
                li.parentNode.removeChild(li);
              } else {
                alert('Problem contacting server');
              }
            }
          })

      });
    });


    </script>

@endsection
