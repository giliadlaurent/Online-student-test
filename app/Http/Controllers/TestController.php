<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Test;
use App\Testdetail;
use App\Question;
use App\Option;
use App\Group;
use App\Http\Requests\StoreTest;
use App\Http\Requests\StoreQuestion;

class TestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function startTest(Test $test, Request $request)
    {
        if (null !== session("start_time") && session("time_limit") !== 0 && session("start_time")+session("time_limit") > time() && $test->id === session('test')->id) {
            return redirect()->action('TestController@showQuestion');
        }
        
        if (Auth::user()->testTaken($test->id)) {
            $request->session()->flash('status_failed', 'You have already taken this test!');
            return redirect('/home');
        }
        session(['questions' => $test->randomizeQuestions(), 'question_counter' => 1, 'test' => $test, 'correct_answers' => 0, 'wrong_answers' => 0, 'is_correct' => false, 'has_failed' => false, 'last_question' => false, 'start_time' => time(), 'time_limit' => $test->time_limit]);
        return redirect()->action('TestController@showQuestion');
    }

    public function showQuestion()
    {
        if (null === session("start_time") || session("time_limit") !== 0 && session("start_time")+session("time_limit") < time()) {
            return redirect()->action('HomeController@index');
        }

        $question = session('questions')->get(session('question_counter')-1);
        $options = $question->options->shuffle();
        session(['options' => $options]);
        return view('tests.index', compact('question'), compact('options'));
    }

    public function answerQuestion(Request $request)
    {
        $question = session('questions')->get(session('question_counter')-1);
        $options = session('options');
        $answers = collect([]);
        foreach ($options as $option) {
            if (array_key_exists("answer{$option->id}", $request->all())) {
                $answers->push($option);
            }
        }

        if ($question->multiple_answers_question) {
            $correct_answers = $question->correct_answers;
            $user_answers_correct = 0;
            foreach ($answers as $answer) {
                if ($answer->correct_answer == 1) {
                    $user_answers_correct++;
                }
            }
            if ($user_answers_correct == $correct_answers) {
                session(['is_correct' => true]);
                session(['correct_answers' => session('correct_answers')+1]);
            } else {
                session(['is_correct' => false]);
                session(['wrong_answers' => session('wrong_answers')+1]);
            }
        }

        if (!$question->multiple_answers_question) {
            if ($answers[0]->correct_answer) {
                session(['is_correct' => true]);
                session(['correct_answers' => session('correct_answers')+1]);
            } else {
                session(['is_correct' => false]);
                session(['wrong_answers' => session('wrong_answers')+1]);
            }
        }

        if (session('test')->lastQuestion(session('question_counter'))) {
            session(['last_question' => true]);
        }

        if (session('test')->timePassed(session('start_time'))) {
            session(['time_passed' => true]);
            session(["wrong_answers" => session("test")->question_count-session("correct_answers")]);
        }

        if (session('test')->hasFailed(session('wrong_answers'))) {
            session(['has_failed' => true]);
        }
        session(['answers' => $answers]);
        session(['question_counter' => session('question_counter')+1]);
        return redirect()->action('TestController@showAnswer');
    }

    public function showAnswer()
    {
        if (!session("time_passed")) {
            if (null === session("start_time") || session("time_limit") !== 0 && session("start_time")+session("time_limit") < time()) {
                return redirect()->action('HomeController@index');
            }
        }

        $question = session('questions')->get(session('question_counter')-2);
        $options = session('options');
        $answers = session('answers');
        return view('tests.answer', compact("question"), compact(["options", "answers"]));
    }

    public function testRetry(Test $test)
    {
        Auth::user()->storeTestdetails($test, session("has_failed"));
        $test->sessionPurge();
        return redirect("/test/$test->id");
    }

    public function testEnd(Test $test)
    {
        Auth::user()->storeTestdetails($test, session("has_failed"));
        $test->sessionPurge();
        return redirect("/home");
    }
}
