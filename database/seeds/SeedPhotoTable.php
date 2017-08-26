<?php

use App\Models\Album;
use Illuminate\Database\Seeder;

class SeedPhotoTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        //Photo::truncate();
        //factory(App\Models\Photo::class, 200)->create();

        $albums = Album::get();
        foreach ($albums as $album) {
            factory(App\Models\Photo::class, 10)->create(
                ['album_id' => $album->id]
            );
        }



    }
}
