@extends('templates.default')

@section('content')

  <h2>PHOTOS</h2>
  @if (session()->has('message'))
    @component('components.alert-info')
      {{session()->get('message')}}
    @endcomponent
  @endif
  <table class="table table-striped">
    <tr>
      <th>CREATE</th>
      <th>TITLE</th>
      <th>ALBUM</th>
      <th>THUMBNAIL</th>
      <th>ACTIONS</th>
    </tr>
    @forelse ($images as $image)
      <tr>
        <td>{{$image->created_at}}</td>
        <td>{{$image->name}}</td>
        <td>{{$album->album_name}}</td>
        <td><img src="{{asset($image->path)}}" width="75" alt=""></td>
        <td>
          <a href="{{route('photos.edit',$image->id)}}" class="btn btn-sm btn-primary">UPDATE</a>
          <a href="{{route('photos.destroy',$image->id)}}" class="btn btn-sm btn-danger">DELETE</a>
        </td>
      </tr>
    @empty
      <tr>
        <td colspan="5">no images</td>
      </tr>
    @endforelse

    <tr>
      <td colspan="6" class="text-center">
        {{$images->links('vendor.pagination.bootstrap-4')}}
      </td>
    </tr>


  </table>
@endsection

@section('footer')
  @parent
    <script>
    $('document').ready(function(){
      $('div.alert').fadeOut(1500);
      $('table').on('click', 'a.btn-danger', function(ele) {
      //$('#delete').click(function(ele) {
        ele.preventDefault();
        /* Act on the event */
        //console.log(ele);
        var urlImg = $(this).attr('href');

        //console.log(myvar);
        //var li = ele.target.parentNode;
        var tr = ele.target.parentNode.parentNode;
//console.log(li);
        $.ajax(
          urlImg,
          {
            method: 'DELETE',
            data: {
              '_token': '{{csrf_token()}}'
            },
            complete : function(resp){
              //console.log(resp);
              if (resp.responseText == 1){
                tr.parentNode.removeChild(tr);
              } else {
                alert('Problem contacting server');
              }
            }
          })

      });
    });


    </script>

@endsection
