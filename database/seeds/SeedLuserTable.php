<?php

use Illuminate\Database\Seeder;

class SeedLuserTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Luser::class, 5)->create();
    }
}
