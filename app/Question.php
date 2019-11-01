<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ["title"];

    public function options()
    {
        return $this->hasMany(Option::class);
    }

    public function test()
    {
        return $this->belongsTo(Test::class);
    }

    public function isCorrect($user_answer)
    {
        if ($user_answer == $this->answer_id) {
            return true;
        }
        return false;
    }

    public function deleteQuestion()
    {
        $options = $this->options;
        foreach ($options as $option) {
            $option->deleteOption();
        }
        $this->delete();
        return true;
    }

    public function addQuestion($test, $request)
    {
        $this->title = $request->title;
        $this->question = $request->question;
        if ($request->multiple_answers_question == null) {
            $this->multiple_answers_question = 0;
            $this->question_type = "radio";
            $this->correct_answers = 1;
        } else {
            $this->multiple_answers_question = $request->multiple_answers_question;
            $this->question_type = "checkbox";
            $correct_answers = 0;
            if ($request->correct_answer1 == 1) {
                $correct_answers++;
            }
            if ($request->correct_answer2 == 1) {
                $correct_answers++;
            }
            if ($request->correct_answer3 == 1) {
                $correct_answers++;
            }
            if ($request->correct_answer4 == 1) {
                $correct_answers++;
            }
            $this->correct_answers = $correct_answers;
        }
        $test->questions()->save($this);
    }

    public function updateQuestion($request)
    {
        $this->title = $request->title;
        $this->question = $request->question;
        if ($request->multiple_answers_question == null) {
            $this->multiple_answers_question = 0;
            $this->question_type = "radio";
            $this->correct_answers = 1;
        } else {
            $this->multiple_answers_question = $request->multiple_answers_question;
            $this->question_type = "checkbox";
            $correct_answers = 0;
            if ($request->correct_answer1 == 1) {
                $correct_answers++;
            }
            if ($request->correct_answer2 == 1) {
                $correct_answers++;
            }
            if ($request->correct_answer3 == 1) {
                $correct_answers++;
            }
            if ($request->correct_answer4 == 1) {
                $correct_answers++;
            }
            $this->correct_answers = $correct_answers;
        }
        $this->update();
    }
}