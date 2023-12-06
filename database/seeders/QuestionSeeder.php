<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Question;
class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            [
                "title" => "what is the latest version of laravel",
                "status" => 1
            ],
            [
                "title" => "what is the latest version of php",
                "status" => 1
            ],
            [
                "title" => "what is the name of laravel inventor",
                "status" => 1
            ]
        );
        Question::insert($data);
    }
}
