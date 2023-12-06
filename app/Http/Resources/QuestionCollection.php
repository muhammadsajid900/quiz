<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Models\Answer;
use App\Models\SkipQuestion;
use App\Models\Question;

class QuestionCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        return [
            'question' => $this->resource['questions'],
            'correctAnswers' => $this->resource['correctAnswers'],
            'inCorrectAnswers' => $this->resource['inCorrectAnswers'],
            'skipedQuestions' => $this->resource['skipedQuestions'],
        ];
    }
}
