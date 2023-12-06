<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Answer;
use App\Models\SkipQuestion;
use App\Http\Resources\QuestionCollection;
use Auth;
class QuestionController extends Controller
{
    public function getQuestions(){

        $skipQuestionIds = SkipQuestion::with('question:id')->where('user_id',Auth::id())->get()->pluck('question.id');
        $answerQuestionIds = Answer::with('questionOption.question:id')->where('user_id',Auth::id())->get()->pluck('questionOption.question.id');
        $questionNotLoad = collect($answerQuestionIds)->merge($skipQuestionIds)->unique()->values()->all();
        $questions = Question::with('options')->whereNotIn('id', $questionNotLoad)->inRandomOrder()->first();
        $correctAnswers = Answer::where('user_id',Auth::id())->where('type',1)->count();
        $inCorrectAnswers = Answer::where('user_id',Auth::id())->where('type',0)->count();
        $skipedQuestions = SkipQuestion::where('user_id',Auth::id())->count();

        $questionResource = new QuestionCollection([
            'questions' => $questions,
            'correctAnswers' => $correctAnswers,
            'inCorrectAnswers' => $inCorrectAnswers,
            'skipedQuestions' => $skipedQuestions,
        ]);

        return response()->json(["status" => "success", "data" => $questionResource],200);
    }

    public function submitAnswer(Request $request){

        $request->validate([
            "optionID" => "required|exists:question_options,id"
        ]);

        try{

            Answer::create([
                "user_id" => Auth::user()->id,
                "question_option_id" => $request->optionID,
                "type" => $request->type,
            ]);

            return response()->json(["status" => "success","message" => "answer submited successfully"]);

        }catch(\Exception $e){
            return response()->json(["status" => "error","message" => $e->getMessage()]);
        }

    }

    public function skipQuestion(Request $request){

        $request->validate([
            "questionID" => "required|exists:questions,id"
        ]);

        try{
            SkipQuestion::create([
                "user_id" => Auth::user()->id,
                "question_id" => $request->questionID,
            ]);
    
            return response()->json(["status" => "success","message" => "question skiped"]);
        }catch(\Exception $e){
            return response()->json(["status" => "error","message" => $e->getMessage()]);
        }

        
    }

}
