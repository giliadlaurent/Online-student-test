<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller {
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$tests = Auth::user()->getTests();
		return view('home', compact('tests'));
	}

	public function stats() {
		return view('stats');
	}

	public function settings() {
		$user = Auth::user();
		return view('users.settings', compact('user'));
	}

	public function updatePassword(Request $request) {
		$this->validate($request, [
			"password" => "required|min:8|confirmed",
			"password_confirmation" => "required_with:password",
		]);

		$user = Auth::user();

		if (!$user->passwordVerify($request->get("password_old"))) {
			$request->session()->flash("status_failed", "The password you entered does not match your current password");
			return redirect('/settings');
		}

		$user->updatePassword($request->get("password"));
		$request->session()->flash('status', 'Your password was updated successfully!');
		return redirect('/settings');
	}

	public function updateEmail(Request $request) {
		$this->validate($request, [
			"email" => "required|email",
		]);

		$user = Auth::user();

		if (!$user->passwordVerify($request->get("password"))) {
			$request->session()->flash("status_failed", "The password you entered does not match your current password");
			return redirect("/settings");
		}

		$user->updateEmail($request->get("email"));
		$request->session()->flash('status', 'Your email was updated successfully!');
		return redirect('/settings');
	}
}
