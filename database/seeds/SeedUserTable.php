<?php


use Illuminate\Database\Seeder;

class SeedUserTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        //DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        //User::truncate();
        factory(App\User::class, 30)->create();

        /*
        $sql = 'INSERT INTO users (name, email, password, created_at) values (:name,:email, :password, :created_at)';

        for($i=0; $i<31; $i++) {
            DB::statement($sql, [
                'name' => $i.'Simone',
                'email' => 'asd@asd.com'.$i,
                'password' => bcrypt('password'),
                'created_at' => Carbon::now(),

            ]);
        }
        */
    }
}
