@extends('templates.default')

@section('content')

  <h2>IMGS</h2>
  @if (session()->has('message'))
    @component('components.alert-info')su
      {{session()->get('message')}}
    @endcomponent
  @endif

  <table class="table table-striped">
    <tr>
      <th>PART</th>
      <th>COLOR</th>
      <th>IMG 1</th>
      <th>IMG 2</th>
    </tr>
   @forelse ($lparts as $lpart)
      <tr>
        <td>{{$lpart->part}}</td>
        <td>{{$lpart->color}}</td>
        <td><img src="http://bricker.info/images/parts/{{$lpart->part}}.jpg" onerror=\"this.src = '//:0';\" width='42'></td>
        <td><img src="https://m.rebrickable.com/media/parts/ldraw/{{$lpart->color}}/{{$lpart->part}}.png" onerror=\"this.src = '//:0';\" width='42'></td>
      </tr>
    @empty
      <tr>
        <td colspan="4">no PARTS</td>
      </tr>
    @endforelse


    <tr>
      <td colspan="4" class="text-center">
        {{$lparts->links('vendor.pagination.bootstrap-4')}}
      </td>
    </tr>

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
