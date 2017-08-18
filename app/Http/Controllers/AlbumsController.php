<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;
use DB;

class AlbumsController extends Controller
{
    public function index( Request $request ){

        //$queryBuilder = DB::table('albums')->orderBy('id','desc');
        $queryBuilder = Album::orderBy('id','desc');

        if($request->has('id')){
            $queryBuilder->where('ID','=', $request->input('id'));
        }

        if($request->has('album_name')){
            $queryBuilder->where('album_name','like', '%'.$request->input('album_name').'%');
        }

        $albums = $queryBuilder->get();

        return view('albums.albums', ['albums' => $albums]);

        /*$sql = 'select * from albums WHERE 1=1 ';
        $where = [];
        if($request->has('id')){
            $where['id'] = $request->get('id');
            $sql .= " AND ID=:id";
        }

        if($request->has('album_name')){
            $where['album_name'] = $request->get('album_name');
            $sql .= " AND album_name=:album_name ";
        }
        $sql .= ' ORDER BY id DESC';

        $albums = DB::select($sql, $where);
        return view('albums.albums', ['albums' => $albums]);
    */}


    public function delete( $id ){

        //dd($id);
        //$res = DB::table('albums')->where('id', $id)->delete();
        //$res = Album::where('id', $id)->delete();
        $res = Album::find($id)->delete();
        return ''.$res;
        /*$sql = 'DELETE from albums WHERE ID= :id';
        return DB::delete($sql, ['id' => $id]);
        */
        //return redirect()->back();
    }

    public function edit( $id ){

        //dd($id);
        //$sql = 'SELECT id, album_name, description from albums WHERE ID = :id';
        //$album = DB::select($sql, ['id'=>$id]);
        $album = Album::find($id);
        //return view('albums.edit')->with('album', $album[0]);
        return view('albums.edit')->with('album', $album);

    }

    public function show( $id ){

        //dd($id);

        $sql = 'SELECT * from albums WHERE ID= :id';
        return DB::select($sql, ['id' => $id]);
    }

    public function store( $id, Request $req ){

        //$res = DB::table('albums')->where('id', $id)->update(
/*
        $res = Album::where('id', $id)->update(
          [
            'album_name' => request()->input('name'),
            'description' => request()->input('description')
          ]
        );
        */
        $album = Album::find($id);
        $album->album_name = request()->input('name');
        $album->description = request()->input('description');
        if($req->hasFile('album_thumb')){
          $file = $req->file('album_thumb');
          $fileName = $file->store(env('ALBUM_THUMB_DIR'));
          $album->album_thumb = $fileName;
        }
        $res = $album->save();
        //dd(request()->all());
        /*
        $data = request()->only(['name','description']);
        $data['id'] = $id;
        $sql = 'UPDATE albums SET album_name=:name, description=:description WHERE ID= :id';
        $res = DB::update($sql, $data);
        */
        $message = $res ? 'Album updated':'Album NON aggionrato';
        session()->flash('message', $message);
        return redirect()->route('albums');
    }

    public function create(){

        return view('albums.createalbum');
    }

    public function save(){

      //$res = DB::table('albums')->insert(
/*
      $res = Album::create(
        [
          'album_name' => request()->input('name'),
          'description' => request()->input('description'),
          'user_id' => 1
        ]
      );
      */
      $album = new Album();
      $album->album_name = request()->input('name');
      $album->description = request()->input('description');
      $album->user_id = 1;
      $res = $album->save();

      /*
      $data = request()->only(['name','description']);
      $data['user_id'] = 1;
      $sql = 'INSERT INTO albums (album_name, description, user_id)';
      $sql .= ' VALUES (:name, :description, :user_id)';

      $res = DB::insert($sql, $data);
      */
      $message = $res ? 'Album created':'Album NON created';
      session()->flash('message', $message);
      return redirect()->route('albums');
      //return view('albums.createalbums');
    }

}
