<?php

namespace App\Http\Controllers;
use DB;
class TestDetails extends Controller
{ 

	function __construct()
	{
	  $this->middleware('auth');
	}
    public function results(){
      
        $results =DB::table('testdetails')
        ->join('tests','testdetails.test_id' ,'=','tests.id')
        ->select('testdetails.passed','testdetails.correct_answers','testdetails.fails',
        'testdetails.last_passed','testdetails.passes','tests.question_count','tests.id')
        ->where('tests.group_id','=',auth()->user()->group_id)
        ->get();

        return view('stats')->with('results',$results);
    }
}
