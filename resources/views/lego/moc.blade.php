<?php //use GuzzleHttp\Client; 

      //$client = new Client();
      //$res = $client->request('GET', 'http://rebrickable.com/api/v3/lego/parts/3001/colors/2/?key=BzyyfQneul');
      //$data = json_decode($res->getBody(), true);
      //$data = json_decode($data, true);
      //dd($data['part_img_url']));
/*
        $client = new Client(['base_uri' => 'http://rebrickable.com/api/v3/lego/']);
	      $response = $client->get('parts/3001/colors/4/?key=BzyyfQneul');
        $data = $response->getBody();
        $data = json_decode($data, true);
        dd($data);
*/
        
        //dd($data['part_img_url']);



//print_r($data['part_img_url']);
            
            //<img src="{{$data['part_img_url']}}">?>

@extends('templates.default')

@section('content')

  <h2>MOC</h2>
  @if (session()->has('message'))
    @component('components.alert-info')su
      {{session()->get('message')}}
    @endcomponent
  @endif

  <table class="table table-striped">
    <tr>
      <th>PART</th>
      <th>DESCRIPTION</th>
      <th>IMG 1</th>
      <th>WHERE</th>
      <th>QTA</th>
      <th>COLOR</th>
      <th>PEER1</th>
      <th>API</th>
      <th>X</th>
    </tr>
    @forelse ($mocs as $moc)
      <tr>
        <td>{{$moc->part}}</td>
        <td>{{$moc->description}}</td>
        <td><img src="http://bricker.info/images/parts/{{$moc->part}}.jpg" onerror=\"this.src = '//:0';\" width='42'></td>
        <td>{{$moc->location}}</td>
        <td>{{$moc->quantity}}</td>
        <td bgcolor='#{{$moc->rgb}}' class='text-white'>{{$moc->color_name}}</td>
        <td><img src="http://media.peeron.com/ldraw/images/{{$moc->color}}/{{$moc->part}}.png" onerror=\"this.src = '//:0';\" width='42'></td>
        <td><img src="https://m.rebrickable.com/media/parts/ldraw/{{$moc->color}}/{{$moc->part}}.png" onerror=\"this.src = '//:0';\" width='42'></td>
        <?php
            //$res = $client->request('GET', 'http://rebrickable.com/api/v3/lego/parts/'.$moc->part.'/colors/'.$moc->color.'/?key=BzyyfQneul');
            //$data = json_decode($res->getBody(), true);
            //echo "<img src='".$data['part_img_url']."' onerror=\'this.src = '//:0';\' width='42'></td>";
        ?>
        <td> </td>
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
