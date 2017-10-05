<?php

use Illuminate\Database\Seeder;

class LusersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('lusers')->delete();
        
        \DB::table('lusers')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Martin Maggio',
                'email' => 'katelyn43@example.net',
                'password' => '$2y$10$TxBdiQYl8SWzP4C2ZJI7L.GQPPuXxC59DcozSLFLSpuLTWvaDZVk6',
                'remember_token' => '5ME2qxY7GP',
                'deleted_at' => NULL,
                'created_at' => '2017-10-03 11:49:32',
                'updated_at' => '2017-10-03 11:49:32',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'DANEEL OLIVAW',
                'email' => 'kayli35@example.net',
                'password' => '$2y$10$TxBdiQYl8SWzP4C2ZJI7L.GQPPuXxC59DcozSLFLSpuLTWvaDZVk6',
                'remember_token' => 'esOROrP1ta',
                'deleted_at' => NULL,
                'created_at' => '2017-10-03 11:49:32',
                'updated_at' => '2017-10-03 11:49:32',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Dr. Ocie Collins',
                'email' => 'bart.hoeger@example.net',
                'password' => '$2y$10$TxBdiQYl8SWzP4C2ZJI7L.GQPPuXxC59DcozSLFLSpuLTWvaDZVk6',
                'remember_token' => 'ZIF5dlh4mH',
                'deleted_at' => NULL,
                'created_at' => '2017-10-03 11:49:32',
                'updated_at' => '2017-10-03 11:49:32',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Lonnie Bartell',
                'email' => 'alexandria19@example.net',
                'password' => '$2y$10$TxBdiQYl8SWzP4C2ZJI7L.GQPPuXxC59DcozSLFLSpuLTWvaDZVk6',
                'remember_token' => 'ExdjqlZ8qF',
                'deleted_at' => NULL,
                'created_at' => '2017-10-03 11:49:32',
                'updated_at' => '2017-10-03 11:49:32',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Dr. Abe Wisozk DVM',
                'email' => 'robyn44@example.com',
                'password' => '$2y$10$TxBdiQYl8SWzP4C2ZJI7L.GQPPuXxC59DcozSLFLSpuLTWvaDZVk6',
                'remember_token' => 'I8UOm5SDEM',
                'deleted_at' => NULL,
                'created_at' => '2017-10-03 11:49:32',
                'updated_at' => '2017-10-03 11:49:32',
            ),
        ));
        
        
    }
}