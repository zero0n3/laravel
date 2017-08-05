<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
class PageController extends Controller
{
  protected $data = [
    [
      'name'=>'Simone',
      'lastname'=>'Bissi'
    ],
    [
      'name'=>'Luca',
      'lastname'=>'Violi'
    ],
    [
      'name'=>'Nadia',
      'lastname'=>'Sbrombal'
    ]
  ];

  public function about(){
    // view about

    return view('about');
  }

  public function blog(){
    // view about

    return view('blog', ['img_url' => 'http://lorempixel.com/400/200/',
                         'img_title' => 'sezione include',
                         'slot' => ''
                        ]);
  }

  public function staff(){
    // view about

    return view('staffb',
      [
        'title' => 'Our Staff',
        'staff' => $this->data
      ]);
  }

}
