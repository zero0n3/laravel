<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class SeedLcategorieTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $sql = 'INSERT INTO lcategories (cat_num, cat_name, created_at) values (:cat_num, :cat_name, :created_at)';

      DB::statement($sql, [
          'cat_num' => '1',
          'cat_name' => 'Baseplates',
          'created_at' => Carbon::now()
      ]);
      DB::statement($sql, [
          'cat_num' => '2',
          'cat_name' => 'Bricks Printed',
          'created_at' => Carbon::now()
      ]);
      DB::statement($sql, [
          'cat_num' => '3',
          'cat_name' => 'Bricks Sloped',
          'created_at' => Carbon::now()
      ]);
      DB::statement($sql, [
          'cat_num' => '4',
          'cat_name' => 'Duplo, Quatro and Primo',
          'created_at' => Carbon::now()
      ]);
      DB::statement($sql, [
          'cat_num' => '5',
          'cat_name' => 'Bricks Special',
          'created_at' => Carbon::now()
      ]);
    }
}
