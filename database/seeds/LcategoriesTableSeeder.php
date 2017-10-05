<?php

use Illuminate\Database\Seeder;

class LcategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('lcategories')->delete();
        
        \DB::table('lcategories')->insert(array (
            0 => 
            array (
                'id' => 1,
                'cat_num' => 1,
                'cat_name' => 'plate',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}