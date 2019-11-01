<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Group;
use App\Test;

class ModeratorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('admin.index');
    }

    public function showUsers()
    {
        $users = Auth::user()->group->getGroupUsers();
        // if($users == Auth::user()->group){
        //     abort("Request is not Allowed",500);
        // }
        return view('users.showall', compact('users'));
    }

    public function showTests()
    {
        $tests = Auth::user()->group->getGroupTests();
        // if($tests !== Auth::user()->group){
        //     abort("Request is not Allowed",404);
        // }
        return view('tests.showall', compact('tests'));
    }

    public function showGroups()
    {
        if (Auth::user()->group_id === 1) {
            return redirect()->action('ModeratorController@showAllTests');
        }

        $groups = Group::find([1, Auth::user()->group_id]);
        return view('admin.groups', compact("groups"));
    }

    public function showAllTests()
    {
        $tests = Test::where("group_id", 1)->orWhere("group_id", Auth::user()->group_id)->get();
        // if($tests !== Auth::user()->group_id){
        //     abort("Request is not Allowed",404);
        // }
        return view('tests.showall', compact("tests"));
    }

    public function showGroupTests(Group $group)
    {
        $tests = $group->tests;
        // if($tests !== Auth::user()->group){
        //     abort("Request is not Allowed",404);
        // }
        return view('tests.showall', compact('tests'));
    }
}
