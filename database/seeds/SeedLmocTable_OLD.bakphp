<?php

use App\Models\Luser;
use Illuminate\Database\Seeder;
use Flynsarmy\CsvSeeder\CsvSeeder;

class SeedLmocTable extends CsvSeeder {

	public function __construct()
	{
		$this->table = 'lcolors';
		$this->filename = base_path().'/database/csvs/lcolors.csv';
	}

	public function run()
	{
		// Recommended when importing larger CSVs
		DB::disableQueryLog();

        // Uncomment the below to wipe the table clean before populating
        //DB::statement('SET FOREIGN_KEY_CHECKS=0;');
		DB::table($this->table)->truncate();

		parent::run();
	}
}

/*
class SeedLmocTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     
    public function run()
    {
      factory(App\Models\Lmoc::class, 20)->create();

    }
}
*/