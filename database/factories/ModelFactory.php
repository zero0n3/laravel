<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

//use App\Models\Luser;
use App\User;
use App\Models\Lcategorie;
use App\Models\Luser;
use App\Models\Lpart;
use App\Models\Lcolor;

$cats =
    ['abstract',
      'animals',
      'business',
      'cats',
      'city',
      'food',
      'nightlife',
      'fashion',
      'people',
      'nature',
      'sports',
      'technics',
      'transport',
    ];



/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});


$factory->define(App\Models\Album::class, function (Faker\Generator $faker) use ($cats){


    return [
        'album_name' => $faker->name,
        'description' => $faker->text(128),
        'user_id' => User::inRandomOrder()->first()->id,
        'album_thumb' => $faker->imageUrl(120, 120, $faker->randomElement($cats))
    ];
});

$factory->define(App\Models\Photo::class, function (Faker\Generator $faker) use ($cats){


    return [
        'album_id' => 1,
        'name' => $faker->text(64),
        'description' => $faker->text(128),
        'img_path' => $faker->imageUrl(640, 480, $faker->randomElement($cats))
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Luser::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Lpart::class, function (Faker\Generator $faker) {
    return [
        'part_num' => $faker->unique()->numberBetween(3023,4000),
        'description' => $faker->text(128),
        'cat_id' => Lcategorie::inRandomOrder()->first()->cat_num,
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Ldblego::class, function (Faker\Generator $faker) {
    return [
        'namedb' => $faker->jobTitle(),
        'user_id' => 1,
        'part' => Lpart::inRandomOrder()->first()->part_num,
        'color' => Lcolor::inRandomOrder()->first()->col_num,
        'quantity' => $faker->randomDigit(),
        'location' => $faker->word()
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Lmoc::class, function (Faker\Generator $faker) {
    return [
        'namemoc' => 'ciaone',
        'user_id' => 1,
        'part' => Lpart::inRandomOrder()->first()->part_num,
        'color' => Lcolor::inRandomOrder()->first()->col_num,
        'quantity' => $faker->randomDigit(),
    ];
});