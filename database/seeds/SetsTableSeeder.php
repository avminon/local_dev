<?php

use Faker\Factory as Faker;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class SetsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $length = 36;
        $setData = [
            [
                'user_id' => 1,
                'category_id' => 2,
                'name' => $this->generateRandomString($length),
                'image' => '',
                'question_language' => '',
                'answer_language' => '',
                'description' => $this->generateRandomString($length),
                'availability' => $this->generateRandomString($length),
            ],
            [
                'user_id' => 2,
                'category_id' => 2,
                'name' => $this->generateRandomString($length),
                'image' => '',
                'question_language' => '',
                'answer_language' => '',
                'description' => $this->generateRandomString($length),
                'availability' => $this->generateRandomString($length),
            ],
            [

                'user_id' => 2,
                'category_id' => 4,
                'name' => $this->generateRandomString($length),
                'image' => '',
                'question_language' => '',
                'answer_language' => '',
                'description' => $this->generateRandomString($length),
                'availability' => $this->generateRandomString($length),

            ],
        ];

        DB::table('sets')->insert($setData);
    }

    protected function generateRandomString($length)
    {
        $faker = Faker::create();
        return $faker->paragraph;
    }

}
