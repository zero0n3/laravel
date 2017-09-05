<?php

use App\Models\Luser;
use Illuminate\Database\Seeder;
use Flynsarmy\CsvSeeder\CsvSeeder;

class SeedLdblegoCsv extends CsvSeeder {

	public function __construct()
	{
		$this->table = 'ldblegos';
		$this->filename = base_path().'/database/csvs/ldblegos.csv';
	}

	public function run()
	{
		// Recommended when importing larger CSVs
		DB::disableQueryLog();

        // Uncomment the below to wipe the table clean before populating
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
		DB::table($this->table)->truncate();

		parent::run();
	}
}