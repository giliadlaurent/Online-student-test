<?php

namespace App\Policies;

use App\Test;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TestPolicy {
	use HandlesAuthorization;

	/**
	 * Determine whether the user can view the test.
	 *
	 * @param  \App\User  $user
	 * @param  \App\Test  $test
	 * @return mixed
	 */
	public function view(User $user, Test $test) {
		if ($user->isAdministrator() || ($user->isModerator() AND ($user->group_id === $test->group_id || $test->group_id === 1))) {
			return true;
		}
		return false;
	}

	/**
	 * Determine whether the user can create tests.
	 *
	 * @param  \App\User  $user
	 * @return mixed
	 */
	public function create(User $user) {
		if ($user->isAdministrator() || $user->isModerator()) {
			return true;
		}
		return false;
	}

	/**
	 * Determine whether the user can update the test.
	 *
	 * @param  \App\User  $user
	 * @param  \App\Test  $test
	 * @return mixed
	 */
	public function update(User $user, Test $test) {
		if ($user->isAdministrator() || ($user->isModerator() AND $user->group_id === $test->group_id)) {
			return true;
		}
		return false;
	}

	/**
	 * Determine whether the user can delete the test.
	 *
	 * @param  \App\User  $user
	 * @param  \App\Test  $test
	 * @return mixed
	 */
	public function delete(User $user, Test $test) {
		if ($user->isAdministrator() || ($user->isModerator() AND $user->group_id === $test->group_id)) {
			return true;
		}
		return false;
	}

	public function createQuestion(User $user, Test $test) {
		if ($user->isAdministrator() || ($user->isModerator() AND $user->group_id === $test->group_id)) {
			return true;
		}
		return false;
	}
}