<?php

use Illuminate\Database\Seeder;

class SeedLpartTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Lpart::class, 100)->create();
    }
}
