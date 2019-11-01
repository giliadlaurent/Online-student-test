<?php

namespace App\Http\Controllers;

use App\Group;
use App\Http\Requests\StoreUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdministrativeUserController extends Controller {
	public function __construct() {
		$this->middleware('auth');
	}

	/**
	 *
	 * Common controller functions between administrators and moderator for handling users.
	 *
	 */
	public function showUser(User $user) {
		$this->authorize('view', $user);

		if (Auth::user()->isAdministrator()) {
			$group = $user->group;
			return view("users.show", compact("group", "user"));
		}
		return view("users.show", compact("user"));
	}

	/**
	 *
	 * Function to show the view used for creating a user.
	 *
	 */
	public function newUser() {
		$this->authorize('create', User::class);

		if (Auth::user()->isAdministrator()) {
			$groups = Group::all();
			return view('users.new', compact('groups'));
		}
		return view('users.new');
	}

	/**
	 *
	 * Function for adding a user.
	 *
	 */
	public function addUser(StoreUser $request) {
		$this->authorize('create', User::class);

		$user = new User;
		$user->addUser($request->all());
		$request->session()->flash('status', 'The user has been created');
		return redirect("/" . Auth::user()->getAdminPath() . "/users/$user->id");
	}

	/**
	 *
	 * Function to show view for editing a user.
	 *
	 */
	public function editUser(User $user) {
		$this->authorize('update', $user);

		if (Auth::user()->isAdministrator()) {
			$groups = Group::all();
			return view("users.edit", compact("groups", "user"));
		}
		return view("users.edit", compact("user"));
	}

	public function updateUser(User $user, StoreUser $request) {
		$this->authorize('update', $user);

		$user->updateUser($request->all());
		$request->session()->flash('status', 'The user has been updated');
		return redirect("/" . Auth::user()->getAdminPath() . "/users/group/$user->group_id");
	}

	/**
	 *
	 * Function for reset a users password
	 *
	 */
	public function resetUserPassword(User $user, Request $request) {
		$this->authorize('resetPassword', $user);

		$user->resetPassword();
		$request->session()->flash('status', 'The password was successfully reset!');
		return redirect("/" . Auth::user()->getAdminPath() . "/users/$user->id");
	}

	public function deleteUser(User $user, Request $request) {
		$this->authorize('delete', $user);

		$user->deleteUser();
		$request->session()->flash('status', 'The user has been deleted');
		return redirect("/" . Auth::user()->getAdminPath() . '/users');
	}
}