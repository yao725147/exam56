<?php

use Illuminate\Database\Seeder;

class TopicsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //每次建立5個題目,並連結至exma_id=5的減法測驗
        factory(App\Topic::class, 5)->create(['exam_id' => 5]);
    }
}
