<?php

namespace App\Http\Controllers;

use App\Models\Lmoc;
use Illuminate\Http\Request;
use DB;

class LegosController extends Controller
{
    public function index( Request $request ){
        
        //return 'Hello MOC';

        //$queryBuilder = DB::table('albums')->orderBy('id','desc');
        
        $queryBuilder = Lmoc::join('lcolors', 'lmocs.color', '=', 'lcolors.col_num')->orderBy('lmocs.id','asc');
/*
        if($request->has('id')){
            $queryBuilder->where('ID','=', $request->input('id'));
        }

        if($request->has('album_name')){
            $queryBuilder->where('album_name','like', '%'.$request->input('album_name').'%');
        }
*/
        $mocs = $queryBuilder->get();

        return view('lego.moc', ['mocs' => $mocs]);

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

}
