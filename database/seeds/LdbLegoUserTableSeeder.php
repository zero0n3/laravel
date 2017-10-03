<?php

use Illuminate\Database\Seeder;

class LdbLegoUserTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('ldb_lego_user')->delete();
        
        \DB::table('ldb_lego_user')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name_db' => 'mia_lista_01',
                'user_id' => 1,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name_db' => 'mia_lista_2',
                'user_id' => 1,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name_db' => 'lista_1_utente_2',
                'user_id' => 2,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'name_db' => 'lista_2_utente_2',
                'user_id' => 2,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'name_db' => 'lista_3_utente_2',
                'user_id' => 2,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'name_db' => 'lista_1_utente_3',
                'user_id' => 3,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}