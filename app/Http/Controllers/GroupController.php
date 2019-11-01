<?php

namespace App\Http\Controllers;

use App\Group;
use App\Http\Requests\StoreGroup;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller {
	public function __construct() {
		$this->middleware('auth');
	}

	public function showGroup(Group $group) {
		$this->authorize('view', $group);

		return view('groups.show', compact('group'));
	}

	public function showGroups() {
		$this->authorize('viewall', Group::class);

		$groups = Group::paginate(5);
		return view('groups.showall', compact('groups'));
	}

	public function newGroup(StoreGroup $request) {
		$this->authorize('create', Group::class);
		$group = new Group;
		$group->addGroup($request->all());
		session()->flash('status', 'New group created successfully!');
		return redirect("/" . Auth::user()->getAdminPath() . "/groups");
	}

	public function addGroup(StoreGroup $request) {
		$this->authorize('create', Group::class);

		$group = new Group;
		$group->addGroup($request->all());
		session()->flash('status', 'New group added successfully!');
		return redirect("/" . Auth::user()->getAdminPath() . "/groups");
	}

	public function editGroup(Group $group) {
		$this->authorize('update', $group);

		return view('groups.edit', compact('group'));
	}

	public function updateGroup(Group $group, StoreGroup $request) {
		$this->authorize('update', $group);

		$group->updateGroup($request->all());
		$request->session()->flash('status', 'The group has been updated');
		return redirect("/" . Auth::user()->getAdminPath() . "/groups/$group->id");
	}

	// public function deleteGroup(Group $group, Request $request)
	// {
	//     $this->authorize('delete', $group);

	//     $group->deleteGroup();
	//     session()->flash('status', 'The group has been deleted');
	//     return redirect("/" . Auth::user()->getAdminPath() . "/groups");
	// }

	public function delete($id) {
		$this->authorize('delete', Group::class);
		$group = Group::find($id);
		$group->delete();
		session()->flash('status', 'The group has been deleted');
		return redirect("/" . Auth::user()->getAdminPath() . "/groups");
	}
}
