<?php

use Faker\Generator as Faker;

$factory->define(App\Topic::class, function (Faker $faker) {
    $items = [1, 2, 3, 4]; //設一個陣列,放4個選項
    shuffle($items); //會把items這個陣列打亂

    // $random_date = $faker->dateTimeBetween('-3 days', '+3 days');
    $num1 = rand(1, 99);
    $num2 = rand(1, 99);
    return [
        'topic'           => "$num1  -  $num2 = ?", //減法測驗
        'opt' . $items[0] => $num1 - $num2,
        'opt' . $items[1] => $num1 . $num2,
        'opt' . $items[2] => $num1 + $num2,
        'opt' . $items[3] => $num2 . $num1,
        'ans'             => $items[0],
        // 'created_at'      => $random_date,
        // 'updated_at'      => $random_date,
    ];
});
