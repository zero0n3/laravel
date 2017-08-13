@extends('templates.default');

@section('content')

  <h2>ALBUMS</h2>
  <ul class="list-group">
    @foreach ($albums as $album)

      <li class="list-group-item justify-content-between">({{$album->id}}) {{$album->album_name}}
            <a href="/albums/{{$album->id}}/delete" class="btn btn-danger">   DELETE</a>
      </li>

    @endforeach

  </ul>

@endsection

@section('footer')
  @parent
    <script>
    $('document').ready(function(){
      $('ul').on('click', 'a', function(ele) {
        ele.preventDefault();
        /* Act on the event */
        var urlAlbum = $(this).attr('href');
        var li = ele.target.parentNode;

        $.ajax(
          urlAlbum,
          {
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
