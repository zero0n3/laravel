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
       
        //$queryBuilder = Lmoc::join('lcolors', 'lmocs.color', '=', 'lcolors.col_num')->orderBy('lmocs.id','asc');
        
        //  1 - PEZZI CHE NON SONO NEL MIO DB - DA COMPRARE TUTTI
        $queryBuilder_1 = Lmoc::selectRaw('lmocs.namemoc, concat("1- ", lmocs.part) AS part, lmocs.color, lmocs.quantity')
        ->join('lparts', 'lmocs.part', '=', 'lparts.part_num' )
        ->join('lcolors', 'lmocs.color', '=', 'lcolors.col_num')
        ->whereNotExists(function ($query) {
				$query->select(DB::raw(1))
				      ->from('ldblegos')
				      ->whereRaw('lmocs.part = ldblegos.part')
				      ->whereRaw('lmocs.color = ldblegos.color');
                		});
                


        //  2a - PEZZI CHE SONO NEL MIO DB MA NON NE HO ABBASTANZA - QUI IMPOSTO LA DIFFERENZA DA COMPRARE
        $queryBuilder_2a = Lmoc::selectRaw('lmocs.namemoc, concat("2a- ", lmocs.part) AS part, lmocs.color, (lmocs.quantity - ldblegos.quantity) as quantity')
        ->join('ldblegos', function($join) {
            $join->on('lmocs.part', '=', 'ldblegos.part');
            $join->on('lmocs.color', '=', 'ldblegos.color');
        })
        ->whereRaw('(lmocs.quantity - ldblegos.quantity) > 0');

	

	
        //  2b - PEZZI CHE SONO NEL MIO DB MA NON NE HO ABBASTANZA - QUI IMPOSTO LA QUANTITA' DEL MIO DB CHE ANDRò AD AZZERARE QUINDI
        $queryBuilder_2b = Lmoc::selectRaw('lmocs.namemoc, concat("2b- ", lmocs.part, " ***") AS part, lmocs.color, ldblegos.quantity')
        ->join('ldblegos', function($join) {
            $join->on('lmocs.part', '=', 'ldblegos.part');
            $join->on('lmocs.color', '=', 'ldblegos.color');
            })
        ->whereRaw('(lmocs.quantity - ldblegos.quantity) > 0');
        
        
        
        //	3a - PEZZI CHE SONO NEL MIO DB E NE HO ABBASTANZA MA NON SONO NEI PEZZI DA ORDINE - PEZZI UNICI CON SACCHETTO DEDICATO
        $queryBuilder_3a = Lmoc::selectRaw('lmocs.namemoc, concat("3a- ", lmocs.part) AS part, lmocs.color, lmocs.quantity')
        ->join('ldblegos', function($join) {
                $join->on('lmocs.part', '=', 'ldblegos.part');
                $join->on('lmocs.color', '=', 'ldblegos.color');
            })
            ->whereRaw('(lmocs.quantity - ldblegos.quantity) <= 0 AND
            lmocs.part NOT IN (
                SELECT DISTINCT lmocs.part
                FROM lmocs
                JOIN ldblegos ON lmocs.part = ldblegos.part 
                WHERE NOT EXISTS (SELECT 1
                    FROM ldblegos 
                    WHERE lmocs.part = ldblegos.part AND lmocs.color = ldblegos.color)
            )');
        
        
        
        
        //	3b - PEZZI CHE SONO NEL MIO DB E NE HO ABBASTANZA E HANNO UN CODICE UGUALE A QUELLI CHE ORDINO PER CUI DEVO TENERLI DA PARTE PRIMA DI CHUDERE I SACCHETTI
        $queryBuilder_3b = Lmoc::selectRaw('lmocs.namemoc, concat("3b- ", lmocs.part, " ***") AS part, lmocs.color, lmocs.quantity')
        ->join('ldblegos', function($join) {
                $join->on('lmocs.part', '=', 'ldblegos.part');
                $join->on('lmocs.color', '=', 'ldblegos.color');
            })
            ->whereRaw('(lmocs.quantity - ldblegos.quantity) <= 0 AND
            lmocs.part IN (
                SELECT DISTINCT lmocs.part
                FROM lmocs
                JOIN ldblegos ON lmocs.part = ldblegos.part 
                WHERE NOT EXISTS (SELECT 1
                    FROM ldblegos 
                    WHERE lmocs.part = ldblegos.part AND lmocs.color = ldblegos.color)
            )');
        
	
	
	
	
        /*
        if($request->has('id')){
            $queryBuilder->where('ID','=', $request->input('id'));
        }

        if($request->has('album_name')){
            $queryBuilder->where('album_name','like', '%'.$request->input('album_name').'%');
        }
		*/
		


        $mocs = $queryBuilder_1
        ->union($queryBuilder_2a)
        ->union($queryBuilder_2b)
        ->union($queryBuilder_3a)
        ->union($queryBuilder_3b)
        ->orderBy('part','asc')->get();
        //dd($mocs);
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
