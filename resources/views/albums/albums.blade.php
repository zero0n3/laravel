@extends('templates.default');

@section('content')

  <h2>ALBUMS</h2>
  <form>
  <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
  <ul class="list-group">
    @foreach ($albums as $album)

      <li class="list-group-item justify-content-between">({{$album->id}}) {{$album->album_name}}
            <a href="/albums/{{$album->id}}/edit" class="btn btn-primary">UPDATE</a>
            <a href="/albums/{{$album->id}}" class="btn btn-danger" id="delete">DELETE</a>
      </li>

    @endforeach

  </ul>
</form>
@endsection

@section('footer')
  @parent
    <script>
    $('document').ready(function(){
      $('ul').on('click', 'a[id="delete"]', function(ele) {
        ele.preventDefault();
        /* Act on the event */
        var urlAlbum = $(this).attr('href');
        //console.log(myvar);
        var li = ele.target.parentNode;

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
