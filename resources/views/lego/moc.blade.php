@extends('templates.default')

@section('content')

  <h2>MOC</h2>
  @if (session()->has('message'))
    @component('components.alert-info')
      {{session()->get('message')}}
    @endcomponent
  @endif

  <table class="table table-striped">
    <tr>
      <th>MOC NAME</th>
      <th>PART</th>
      <th>COLOR</th>
      <th>QUANTITY</th>
    </tr>
    @forelse ($mocs as $moc)
      <tr>
        <td>{{$moc->namemoc}}</td>
        <td>{{$moc->part}}</td>
        <td>{{$moc->color}}</td>
        <td>{{$moc->quantity}}</td>
      </tr>
    @empty
      <tr>
        <td colspan="5">no PARTS</td>
      </tr>
    @endforelse

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
