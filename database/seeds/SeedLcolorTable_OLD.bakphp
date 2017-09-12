<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class SeedLcolorTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      $sql = 'INSERT INTO lcolors (col_num, color_name, rgb, trasp, created_at) values (:col_num, :color_name, :rgb, :trasp, :created_at)';

      DB::statement($sql, [
          'col_num' => '0',
          'color_name' => 'Black',
          'rgb' => '05131D',
          'trasp' => '0',
          'created_at' => Carbon::now()
      ]);
      DB::statement($sql, [
          'col_num' => '1',
          'color_name' => 'Blue',
          'rgb' => '0055BF',
          'trasp' => '0',
          'created_at' => Carbon::now()
      ]);
      DB::statement($sql, [
          'col_num' => '2',
          'color_name' => 'Green',
          'rgb' => '237841',
          'trasp' => '0',
          'created_at' => Carbon::now()
      ]);
      DB::statement($sql, [
          'col_num' => '3',
          'color_name' => 'Dark Turquoise',
          'rgb' => '008F9B',
          'trasp' => '0',
          'created_at' => Carbon::now()
      ]);
      DB::statement($sql, [
          'col_num' => '4',
          'color_name' => 'Red',
          'rgb' => 'C91A09',
          'trasp' => '0',
          'created_at' => Carbon::now()
      ]);
      DB::statement($sql, [
          'col_num' => '71',
          'color_name' => 'Dark Bluish Gray',
          'rgb' => 'C91A09',
          'trasp' => '0',
          'created_at' => Carbon::now()
      ]);
      DB::statement($sql, [
          'col_num' => '72',
          'color_name' => 'Light Bluish Gray',
          'rgb' => 'C91A09',
          'trasp' => '0',
          'created_at' => Carbon::now()
      ]);
    }
}
