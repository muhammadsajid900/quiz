<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\QuestionOption;
class OptionsSeeder extends Seeder
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
                "question_id" => 1,
                "title" => "10",
                "type" => 1,
                "status" => 1
            ],
            [
                "question_id" => 1,
                "title" => "9",
                "type" => 0,
                "status" => 1
            ],
            [
                "question_id" => 1,
                "title" => "8",
                "type" => 0,
                "status" => 1
            ],
            [
                "question_id" => 2,
                "title" => "8",
                "type" => 1,
                "status" => 1
            ],
            [
                "question_id" => 2,
                "title" => "11",
                "type" => 0,
                "status" => 1
            ],
            [
                "question_id" => 2,
                "title" => "10",
                "type" => 0,
                "status" => 1
            ],
            [
                "question_id" => 2,
                "title" => "9",
                "type" => 0,
                "status" => 1
            ],
            [
                "question_id" => 3,
                "title" => "Taylor Otwell",
                "type" => 1,
                "status" => 1
            ],
            [
                "question_id" => 3,
                "title" => "Taylor jans",
                "type" => 0,
                "status" => 1
            ],
            [
                "question_id" => 3,
                "title" => "Taylor sam",
                "type" => 0,
                "status" => 1
            ],
            
        );
        QuestionOption::insert($data);
    }
}
