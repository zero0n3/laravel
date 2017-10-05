<?php

use App\User;
use App\Models\Luser;
use App\Models\Album;
use App\Models\Lcolor;
use App\Models\Lpart;
use App\Models\Ldblego;
use App\Models\Lmoc;
use App\Models\Lcategorie;
use App\Models\Photo;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        User::truncate();
        Album::truncate();
        Photo::truncate();
        Luser::truncate();
        //Ldblego::truncate();
        //Lpart::truncate();
        //Luser::truncate();
        //Lcolor::truncate();
        //Lcategorie::truncate();
        //Lmoc::truncate();

        $this->call(SeedUserTable::class);
        $this->call(SeedAlbumTable::class);
        $this->call(SeedPhotoTable::class);

        // LEGO
        //$this->call(SeedLcategorieTable::class);
        //$this->call(SeedLuserTable::class);
        //$this->call(SeedLcolorTable::class);
        //$this->call(SeedLpartTable::class);
        //$this->call(SeedLdblegoTable::class);
        //$this->call(SeedLmocTable::class);
        $this->call(LusersTableSeeder::class);
        $this->call(LdbLegoUserTableSeeder::class);
        $this->call(LcategoriesTableSeeder::class);
        $this->call(LcolorsTableSeeder::class);
    }
}
