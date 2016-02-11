<?php

use Faker\Factory as Faker;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class TermsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $length = 36;
        $faker = Faker::create();
        $termData = [
            [
                'set_id' => $faker->numberBetween(1, 5),
                'question' => $this->generateSentence($length),
                'answer' => $this->generateSentence($length),
            ],
            [
                'set_id' => $faker->numberBetween(1, 5),
                'question' => $this->generateSentence($length),
                'answer' => $this->generateSentence($length),
            ],
            [
                'set_id' => $faker->numberBetween(1, 5),
                'question' => $this->generateSentence($length),
                'answer' => $this->generateSentence($length),
            ],
            [
                'set_id' => $faker->numberBetween(1, 5),
                'question' => $this->generateSentence($length),
                'answer' => $this->generateSentence($length),
            ],
            [
                'set_id' => $faker->numberBetween(1, 5),
                'question' => $this->generateSentence($length),
                'answer' => $this->generateSentence($length),
            ],
        ];

        DB::table('terms')->insert($termData);
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
