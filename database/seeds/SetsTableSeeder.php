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
                'name' => 'Things at the park.',
                'image' => '',
                'question_language' => '',
                'answer_language' => '',
                'description' => $this->generateRandomString($length),
                'availability' => $this->generateWord($length),
            ],
            [
                'user_id' => 2,
                'category_id' => 2,
                'name' => 'Things you see at home.',
                'image' => '',
                'question_language' => '',
                'answer_language' => '',
                'description' => $this->generateRandomString($length),
                'availability' => $this->generateWord($length),
            ],
            [
                'user_id' => 2,
                'category_id' => 4,
                'name' => 'Television shows.',
                'image' => '',
                'question_language' => '',
                'answer_language' => '',
                'description' => $this->generateRandomString($length),
                'availability' => $this->generateWord($length),

            ],
            [
                'user_id' => 1,
                'category_id' => 3,
                'name' => 'Famous food',
                'image' => '',
                'question_language' => '',
                'answer_language' => '',
                'description' => $this->generateRandomString($length),
                'availability' => $this->generateWord($length),

            ],
            [
                'user_id' => 1,
                'category_id' => 2,
                'name' => 'Riding the train',
                'image' => '',
                'question_language' => '',
                'answer_language' => '',
                'description' => $this->generateRandomString($length),
                'availability' => $this->generateWord($length),

            ],
        ];

        DB::table('sets')->insert($setData);
    }

    protected function generateRandomString($length)
    {
        $faker = Faker::create();
        return $faker->paragraph;
    }

    protected function generateSentence($length)
    {
        $faker = Faker::create();
        return $faker->sentence;
    }

    protected function generateWord($length)
    {
        $faker = Faker::create();
        return $faker->word;
    }

}
