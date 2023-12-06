<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','question_option_id','type'];

    public function questionOption()
    {
        return $this->belongsTo(QuestionOption::class, 'question_option_id');
    }
}
