@extends('templates.default')
  @section('title', 'Blog')

@section('content')

  <h2>BLOG</h2>
  @component('components.card',
    [
      'img_title' => 'Image blog',
      'img_url' => 'http://lorempixel.com/400/200/'
    ]
    )
    <p>this is a beautiful image i took in nyc</p>

  @endcomponent

  @component('components.card')
    @slot('img_url', 'http://lorempixel.com/400/200/')
    @slot('img_title', 'Ciaone')


    <p>this is a beautiful image i took in nyc</p>

  @endcomponent

@endsection


@include('components.card')


@section('footer')
  @parent
  <script>
    //alert('blog')
  </script>
@endsection
