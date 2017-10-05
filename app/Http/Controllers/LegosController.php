<?php

namespace App\Http\Controllers;

use App\Models\Lmoc;
use App\Models\Ldblego;
use Illuminate\Http\Request;
use DB;



class LegosController extends Controller
{
    public function index( Request $request ){
        
        //  1 - PEZZI CHE NON SONO NEL MIO DB - DA COMPRARE TUTTI
        $queryBuilder_1 = Lmoc::selectRaw('lcolors.color_name, lcolors.rgb,lparts.description, lmocs.part, lmocs.color, lmocs.quantity')
        ->leftJoin('lparts', 'lmocs.part', '=', 'lparts.part_num' )
        ->leftJoin('lcolors', 'lmocs.color', '=', 'lcolors.col_num')
        ->whereNotExists(function ($query) {
				$query->select(DB::raw(1))
				      ->from('ldb_part')
				      ->whereRaw('lmocs.part = ldb_part.part AND lmocs.color = ldb_part.color');
                		});
                


        //  2a - PEZZI CHE SONO NEL MIO DB MA NON NE HO ABBASTANZA - QUI IMPOSTO LA DIFFERENZA DA COMPRARE
        $queryBuilder_2a = Lmoc::selectRaw('lcolors.color_name, lcolors.rgb,lparts.description, concat("2a- ", lmocs.part) AS part, lmocs.color, (lmocs.quantity - ldb_part.quantity) as quantity')
        ->leftJoin('lparts', 'lmocs.part', '=', 'lparts.part_num' )
        ->leftJoin('lcolors', 'lmocs.color', '=', 'lcolors.col_num')
        ->join('ldb_part', function($join) {
            $join->on('lmocs.part', '=', 'ldb_part.part');
            $join->on('lmocs.color', '=', 'ldb_part.color');
        })
        ->whereRaw('(lmocs.quantity - ldb_part.quantity) > 0');

	
	
        //  2b - PEZZI CHE SONO NEL MIO DB MA NON NE HO ABBASTANZA - QUI IMPOSTO LA QUANTITA' DEL MIO DB CHE ANDRò AD AZZERARE QUINDI
        $queryBuilder_2b = Lmoc::selectRaw('lcolors.color_name, lcolors.rgb,lparts.description, concat("2b- ", lmocs.part, " ***") AS part, lmocs.color, ldb_part.quantity')
        ->leftJoin('lparts', 'lmocs.part', '=', 'lparts.part_num' )
        ->leftJoin('lcolors', 'lmocs.color', '=', 'lcolors.col_num')
        ->join('ldb_part', function($join) {
            $join->on('lmocs.part', '=', 'ldb_part.part');
            $join->on('lmocs.color', '=', 'ldb_part.color');
            })
        ->whereRaw('(lmocs.quantity - ldb_part.quantity) > 0');
        
        
        
        //	3a - PEZZI CHE SONO NEL MIO DB E NE HO ABBASTANZA MA NON SONO NEI PEZZI DA ORDINE - PEZZI UNICI CON SACCHETTO DEDICATO
        $queryBuilder_3a = Lmoc::selectRaw('lcolors.color_name, lcolors.rgb,lparts.description, concat("3a- ", lmocs.part) AS part, lmocs.color, lmocs.quantity')
        ->leftJoin('lparts', 'lmocs.part', '=', 'lparts.part_num' )
        ->leftJoin('lcolors', 'lmocs.color', '=', 'lcolors.col_num')
        ->join('ldb_part', function($join) {
                $join->on('lmocs.part', '=', 'ldb_part.part');
                $join->on('lmocs.color', '=', 'ldb_part.color');
            })
            ->whereRaw('(lmocs.quantity - ldb_part.quantity) <= 0 AND
            lmocs.part NOT IN (
                SELECT DISTINCT lmocs.part
                FROM lmocs
                JOIN ldb_part ON lmocs.part = ldb_part.part 
                WHERE NOT EXISTS (SELECT 1
                    FROM ldb_part 
                    WHERE lmocs.part = ldb_part.part AND lmocs.color = ldb_part.color)
            )');
        
        
        
        //	3b - PEZZI CHE SONO NEL MIO DB E NE HO ABBASTANZA E HANNO UN CODICE UGUALE A QUELLI CHE ORDINO PER CUI DEVO TENERLI DA PARTE PRIMA DI CHUDERE I SACCHETTI
        $queryBuilder_3b = Lmoc::selectRaw('lcolors.color_name, lcolors.rgb,lparts.description, concat("3b- ", lmocs.part, " ***") AS part, lmocs.color, lmocs.quantity')
        ->leftJoin('lparts', 'lmocs.part', '=', 'lparts.part_num' )
        ->leftJoin('lcolors', 'lmocs.color', '=', 'lcolors.col_num')
        ->join('ldb_part', function($join) {
                $join->on('lmocs.part', '=', 'ldb_part.part');
                $join->on('lmocs.color', '=', 'ldb_part.color');
            })
            ->whereRaw('(lmocs.quantity - ldb_part.quantity) <= 0 AND
            lmocs.part IN (
                SELECT DISTINCT lmocs.part
                FROM lmocs
                JOIN ldb_part ON lmocs.part = ldb_part.part 
                WHERE NOT EXISTS (SELECT 1
                    FROM ldb_part 
                    WHERE lmocs.part = ldb_part.part AND lmocs.color = ldb_part.color)
            )');

            






        //  RISULTATO
        $mocs = $queryBuilder_1
        //->union($queryBuilder_2a)
        //->union($queryBuilder_2b)
        //->union($queryBuilder_3a)
        //->union($queryBuilder_3b)
        ->orderBy('part','asc')->get()->toArray();
        

        //foreach($mocs as $m){
            //echo $m['part']."<br>";
            //$array[] = $m['part'];

        //}
        /*
        $result = DB::select($query)->toArray();
        
        foreach($result as $r){
            echo $r['email'];
        }
        */
        dd($mocs);
        
        return view('lego.moc', ['mocs' => $mocs]);
    }



    public function parts( Request $request ){
        
    	$queryBuilder = Ldblego::orderBy('part','asc');
    	    
    	$lparts = $queryBuilder->paginate(50);
            
    	return view('lego.parts', ['lparts' => $lparts]);
       
        
    }


       /**
     * @param Request $req
     * @param mixed   $id
     * @param mixed   $album
     */
    public function processFileLego(Request $req, $id, &$album){
      if(!$req->hasFile('album_thumb')){
        return false;
      }

      $file = $req->file('album_thumb');
      if(!$file->isValid()){
        return false;
      }


      $fileName = $id . '.' . $file->extension();
      $file->storeAs(env('ALBUM_THUMB_DIR'), $fileName);
      $album->album_thumb = env('ALBUM_THUMB_DIR').$fileName;
      return true;
    }



}
