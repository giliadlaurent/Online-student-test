<?php

namespace App\Http\Controllers;

use App\Group;
use App\Test;
use App\User;

class AdminController extends Controller {
	public function __construct() {
		$this->middleware('auth');
	}

	public function index() {
		return view('admin.index');
	}

	public function showGroups() {
		$groups = Group::paginate(8);
		return view('admin.groups', compact('groups'));
	}

	public function showAllUsers() {
		$users = User::paginate(6);
		return view('users.showall', compact('users'));
	}

	public function showGroupUsers(Group $group) {
		$users = $group->users;
		return view('users.showall', compact('users'));
	}

	public function showAllTests() {

		$tests = Test::paginate(5);
		return view('tests.showall', compact('tests'));
	}

	public function showGroupTests(Group $group) {

		$tests = $group->tests;
		if ($group->id == 1) {
			return back()->with('status','You can not assign test to yourself .! Assign to students');
		}
		return view('tests.showall', compact('tests'));
	}

}
