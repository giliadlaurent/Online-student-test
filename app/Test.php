<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Test extends Model
{
    protected $fillable = ["title", "question_count", "question_count_to_fail, time_limit"];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function testdetails()
    {
        return $this->hasMany(Testdetail::class);
    }



    public function randomizeQuestions()
    {
        return $this->questions->random($this->question_count)->shuffle();
    }

    public function hasFailed($wrong_answers)
    {
        if ($this->question_count_to_fail == null) {
            return false;
        }
        return $this->question_count_to_fail < $wrong_answers;
    }

    public function lastQuestion($question_counter)
    {
        if ($this->question_count == $question_counter) {
            return true;
        }
        return false;
    }

    public function createTest($request)
    {
        $this->title = $request["title"];
        $this->question_count = $request["question_count"];
        if ($request["question_count_to_fail"])  {
            $this->question_count_to_fail = $request["question_count_to_fail"];
        }
        $this->time_limit = $request["time_limit"];
        if (Auth::user()->isAdministrator()) {
            $this->group_id = $request["group_id"];
            $this->save();
            return true;
        }
        Group::find(Auth::user()->group_id)->tests()->save($this);
        return true;
    }

    public function updateTest($request)
    {
        $this->update($request);
    }

    public function nextQuestionNumber()
    {
        return count($this->questions)+1;
    }

    public function deleteTest()
    {
        $questions = $this->questions;
        foreach ($questions as $question) {
            $question->deleteQuestion();
        }
        $this->delete();
        return true;
    }

    public function sessionPurge()
    {
        session(['questions' => null, 'question_counter' => null, 'test' => null, 'wrong_answers' => null,
         'correct_answers' => null, 'is_correct' => null, 'has_failed' => null, 'last_question' => null, 'options' => null,
         'start_time' => null, 'time_limit' => null, 'answers' => null]);
        return true;
    }

    public function timePassed($start_time)
    {
        if ($start_time+$this->time_limit < time()) {
            return true;
        }
        return false;
    }

    public function timeLimitInMinutes()
    {
        return $this->time_limit/60;
    }

    public function timeLimitInHours()
    {
        return $this->time_limit/60/60;
    }

    public function progressBarWidth($question_counter)
    {
        return 100/$this->question_count*$question_counter;
    }
}
