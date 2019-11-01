<?php

namespace App;

use App\Test;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Group extends Model
{
    protected $fillable = ["name"];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function tests()
    {
        return $this->hasMany(Test::class);
    }

    public function getGroupTests()
    {
        return $this->tests;
    }

    public function getGroupUsers()
    {
        return $this->users;
    }

    public function addGroup($request)
    {
        $this->name = $request["name"];
        $this->save();
        return true;
    }

    public function updateGroup($request)
    {
        $this->update($request);
        return true;
    }

    public function deleteGroup()
    {
        if (Auth::user()->isAdministrator()) {
            $this->delete();
            return true;
        }
        return false;

    }
}
