<?php

use App\Models\Luser;
use Illuminate\Database\Seeder;

class SeedLmocTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      factory(App\Models\Lmoc::class, 20)->create();

    }
}
