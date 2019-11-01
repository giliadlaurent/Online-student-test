<?php

namespace App\Http\Controllers;

use App\Group;
use App\Http\Requests\StoreQuestion;
use App\Http\Requests\StoreTest;
use App\Option;
use App\Question;
use App\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdministrativeTestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     *
     * Common controller functions between moderators 
     *  and administrators for handling tests
     */
    public function showTest(Test $test)
    {
        $this->authorize('view', $test);

        $questions = Question::where("test_id", $test->id)->with("options")->get();
        return view('tests.show', compact('test'), compact('questions'));
    }

    public function newTest()
    {
        $this->authorize('create', Test::class);

        if (Auth::user()->isAdministrator()) {
            $groups = Group::all();
            return view('tests.new', compact('groups'));
        }
        return view('tests.new');
    }

    public function addTest(StoreTest $request)
    {
        $this->authorize('create', Test::class);
        $test = new Test();
        $test->createTest($request->all());
        return redirect("/" . Auth::user()->getAdminPath() . "/tests/$test->id")
            ->with('status', 'The test has been created');
    }

    public function editTest(Test $test)
    {
        $this->authorize('update', $test);

        if (Auth::user()->isAdministrator()) {
            $groups = Group::all();
            return view('tests.edit', compact('test'), compact('groups'));
        }
        return view('tests.edit', compact('test'));
    }

    public function updateTest(Test $test, StoreTest $request)
    {
        $this->authorize('update', $test);

        $test->updateTest($request->all());
        return back()->with('status', 'The test has been updated');
    }

    public function deleteTest(Test $test)
    {
        $this->authorize('delete', $test);

        $test->deleteTest();
        return back()->with('status', 'The test has been deleted');
    }

    /**
     *
     * Common controller functions between moderators and administrators for handling questions
     *
     */
    public function newQuestion(Test $test)
    {
        $this->authorize('createQuestion', $test);
        $this->authorize('create', Question::class);

        $question_number = $test->nextQuestionNumber();
        return view('tests.question.new', compact('test'), compact('question_number'));
    }

    public function addQuestion(Test $test, StoreQuestion $request)
    {
        $this->authorize('createQuestion', $test);
        $this->authorize('create', Question::class);

        $question = new Question;
        $question->addQuestion($test, $request);
        foreach ($request["options"] as $optionData) {
            $option = new Option;
            $option->addOption($question, $optionData);
        }
        $request->session()->flash('status', 'The question has been created');
        return redirect("/" . Auth::user()->getAdminPath() . "/tests/$test->id");
    }

    public function editQuestion(Question $question)
    {
        $this->authorize('update', $question);

        $options = $question->options;
        return view('tests.question.edit', compact('question'), compact('options'));
    }

    public function updateQuestion(Question $question, StoreQuestion $request)
    {
        $this->authorize('update', $question);

        $test = $question->test;
        $question->updateQuestion($request);
        $options = $question->options;
        $optionsData = $request["options"];
        foreach ($options as $key => $option) {
            $option->updateOption($optionsData[$key + 1]);
        }
        $request->session()->flash('status', 'The question has been updated');
        return redirect("/" . Auth::user()->getAdminPath() . "/tests/$test->id");
    }

    public function deleteQuestion(Question $question, Request $request)
    {
        $this->authorize('delete', $question);

        $test = $question->test;
        $question->deleteQuestion();
        $request->session()->flash('status', 'The question has been deleted');
        return redirect("/" . Auth::user()->getAdminPath() . "/tests/$test->id");
    }
}
