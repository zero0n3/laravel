<?php

use App\Models\Luser;
use Illuminate\Database\Seeder;

class SeedLdblegoTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $lusers = Luser::get();

      foreach ($lusers as $luser) {
          factory(App\Models\Ldblego::class, 15)->create(
              ['user_id' => $luser->id]
          );
      }

        //factory(App\Models\Ldblego::class, 100)->create();
    }
}
