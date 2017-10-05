<?php

use Illuminate\Database\Seeder;

class LcolorsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('lcolors')->delete();
        
        \DB::table('lcolors')->insert(array (
            0 => 
            array (
                'id' => 1,
                'col_num' => 0,
                'color_name' => 'Black',
                'rgb' => '05131D',
                'trasp' => 'f   ',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'col_num' => 1,
                'color_name' => 'Blue',
                'rgb' => '0055BF',
                'trasp' => 'f   ',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'col_num' => 2,
                'color_name' => 'Green',
                'rgb' => '237841',
                'trasp' => 'f   ',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'col_num' => 4,
                'color_name' => 'Red',
                'rgb' => 'C91A09',
                'trasp' => 'f   ',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'col_num' => 5,
                'color_name' => 'Dark Pink',
                'rgb' => 'C870A0',
                'trasp' => 'f   ',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'col_num' => 6,
                'color_name' => 'Brown',
                'rgb' => '583927',
                'trasp' => 'f   ',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'col_num' => 7,
                'color_name' => 'Light Gray',
                'rgb' => '9BA19D',
                'trasp' => 'f   ',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'col_num' => 14,
                'color_name' => 'Yellow',
                'rgb' => 'F2CD37',
                'trasp' => 'f   ',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'col_num' => 15,
                'color_name' => 'White',
                'rgb' => 'FFFFFF',
                'trasp' => 'f   ',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'col_num' => 19,
                'color_name' => 'Tan',
                'rgb' => 'E4CD9E',
                'trasp' => 'f   ',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'col_num' => 25,
                'color_name' => 'Orange',
                'rgb' => 'FE8A18',
                'trasp' => 'f   ',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            11 => 
            array (
                'id' => 12,
                'col_num' => 34,
                'color_name' => 'Trans-Green',
                'rgb' => '84B68D',
                'trasp' => 't   ',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            12 => 
            array (
                'id' => 13,
                'col_num' => 36,
                'color_name' => 'Trans-Red',
                'rgb' => 'C91A09',
                'trasp' => 't   ',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            13 => 
            array (
                'id' => 14,
                'col_num' => 40,
                'color_name' => 'Trans-Black',
                'rgb' => '635F52',
                'trasp' => 't   ',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            14 => 
            array (
                'id' => 15,
                'col_num' => 41,
                'color_name' => 'Trans-Light Blue',
                'rgb' => 'AEEFEC',
                'trasp' => 't   ',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            15 => 
            array (
                'id' => 16,
                'col_num' => 42,
                'color_name' => 'Trans-Neon Green',
                'rgb' => 'F8F184',
                'trasp' => 't   ',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            16 => 
            array (
                'id' => 17,
                'col_num' => 46,
                'color_name' => 'Trans-Yellow',
                'rgb' => 'F5CD2F',
                'trasp' => 't   ',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            17 => 
            array (
                'id' => 18,
                'col_num' => 47,
                'color_name' => 'Trans-Clear',
                'rgb' => 'FCFCFC',
                'trasp' => 't   ',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            18 => 
            array (
                'id' => 19,
                'col_num' => 57,
                'color_name' => 'Trans-Neon Orange',
                'rgb' => 'FF800D',
                'trasp' => 't   ',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            19 => 
            array (
                'id' => 20,
                'col_num' => 70,
                'color_name' => 'Reddish Brown',
                'rgb' => '582A12',
                'trasp' => 'f   ',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            20 => 
            array (
                'id' => 21,
                'col_num' => 71,
                'color_name' => 'Light Bluish Gray',
                'rgb' => 'A0A5A9',
                'trasp' => 'f   ',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            21 => 
            array (
                'id' => 22,
                'col_num' => 72,
                'color_name' => 'Dark Bluish Gray',
                'rgb' => '6C6E68',
                'trasp' => 'f   ',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            22 => 
            array (
                'id' => 23,
                'col_num' => 80,
                'color_name' => 'Metallic Silver',
                'rgb' => 'A5A9B4',
                'trasp' => 'f   ',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            23 => 
            array (
                'id' => 24,
                'col_num' => 191,
                'color_name' => 'Bright Light Orange',
                'rgb' => 'F8BB3D',
                'trasp' => 'f  ',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            24 => 
            array (
                'id' => 25,
                'col_num' => 308,
                'color_name' => 'Dark Brown',
                'rgb' => '352100',
                'trasp' => 'f   ',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            25 => 
            array (
                'id' => 26,
                'col_num' => 322,
                'color_name' => 'Medium Azure',
                'rgb' => '36AEBF',
                'trasp' => 'f   ',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            26 => 
            array (
                'id' => 27,
                'col_num' => 503,
                'color_name' => 'Very Light Gray',
                'rgb' => 'E6E3DA',
                'trasp' => 'f   ',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            27 => 
            array (
                'id' => 28,
                'col_num' => 1000,
                'color_name' => 'Glow in Dark White',
                'rgb' => 'D9D9D9',
                'trasp' => 'f  ',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}