<?php

namespace App;

use App\Group;
use App\Testdetail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function testdetails()
    {
        return $this->hasMany(Testdetail::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function passwordHash($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public function passwordVerify($password)
    {
        return password_verify($password, $this->password);
    }

    public function generatePassword(Int $length)
    {
        $chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWZYZabcdefghijklmnopqrstuvwxyz";
        $password = "";
        $char_max = strlen($chars) - 1;

        for ($i = 0; $i < $length; ++$i) {
            $password .= $chars[random_int(0, $char_max)];
        }

        return $password;
    }

    public function resetPassword()
    {
        $this->password = $this->passwordHash($this->generatePassword(12));
        $this->update();
        return true;
    }

    public function isModerator()
    {
        if ($this->access_level === 2) {
            return true;
        }
        return false;
    }

    public function isAdministrator()
    {
        if ($this->access_level === 3) {
            return true;
        }
        return false;
    }

    /**
     *
     * Function for adding a user.
     *
     */
    public function addUser($request)
    {
        $this->name = $request["name"];
        $this->email = trim($request["email"]);
        $this->enabled = $request["enabled"];
        $this->access_level = $request["access_level"];

        if (array_key_exists("password", $request)) {
            $this->password = $this->passwordHash($request["password"]);
        } else {
            $this->password = $this->passwordHash($this->generatePassword(12));
        }

        if (Auth::user()->isModerator()) {
            $this->group_id = Auth::user()->group_id;
        }

        if (Auth::user()->isAdministrator()) {
            $this->group_id = $request["group_id"];
        }

        $this->save();
    }

    /**
     *
     * Function for updating a user.
     *
     */
    public function updateUser($request)
    {
        $this->name = $request["name"];
        $this->email = trim($request["email"]);
        $this->enabled = $request["enabled"];

        if (array_key_exists("password", $request)) {
            $this->password = $this->passwordHash($request["password"]);
        }

        if ($request["reset-password"]) {
            $this->password = $this->passwordHash($this->generatePassword(12));
        }

        if (Auth::user()->isAdministrator()) {
            $this->access_level = $request["access_level"];
            $this->group_id = $request["group_id"];
        }
        $this->update();
    }

    /**
     *
     * Function for deleting user.
     *
     */
    public function deleteUser()
    {
        $this->delete();
    }

    /**
     *
     * Functions for a user to update his/her email and password
     *
     */
    public function updateEmail($email)
    {
        $this->email = trim($email);
        $this->update();
    }

    public function updatePassword($password)
    {
        $this->password = $this->passwordHash($password);
        $this->update();
    }

    public function testTaken($test_id)
    {
        if (!$this->testdetails()->where('test_id', $test_id)->first()) {
            return false;
        }

        if (!$this->testdetails()->where('test_id', $test_id)->first()->passed >= 1) {
            return false;
        }

        return true;
    }

    public function getGeneralTests()
    {
        return Test::where("group_id", 1)->get();
    }

    public function getTests()
    {
        $test_general = $this->getGeneralTests();
        $testdetails = $this->testdetails;

        if ($this->group_id > 1) {
            $test_group = $this->group->getGroupTests();
            $unsorted_tests = $test_group->merge($test_general);
        } else {
            $unsorted_tests = $test_general;
        }

        $available_tests = [];
        $completed_tests = [];

        foreach ($unsorted_tests as $test) {
            $testdetail = $testdetails->where("test_id", $test->id)->first();
            if ($testdetail && $testdetail->passed) {
                $completed_tests[] = $test;
            } else {
                $available_tests[] = $test;
            }
        }

        $tests = [$available_tests, $completed_tests, $testdetails];
        return $tests;

    }

    public function storeTestdetails($test, $has_failed)
    {
        if (empty($this->testdetails->where("test_id", $test->id)->first())) {
            $this->addTestdetails($test, $has_failed);
        } else {
            $this->updateTestdetails($test, $has_failed);
        }
        return true;
    }

    public function addTestdetails($test, $has_failed)
    {
        $testdetails = new Testdetail;
        $testdetails->test_id = $test->id;
        $testdetails->correct_answers = session("correct_answers");

        if ($has_failed == true) {
            $testdetails->fails += 1;
        }

        if ($has_failed == false) {
            $testdetails->passed = 1;
            $testdetails->passes += 1;
            $testdetails->last_passed = date("Y-m-d H:i:s");
        }

        $this->testdetails()->save($testdetails);
        return true;
    }

    public function updateTestdetails($test, $has_failed)
    {
        $testdetails = $this->testdetails->where("test_id", $test->id)->first();
        $testdetails->correct_answers = session("correct_answers");

        if ($has_failed == true) {
            $testdetails->fails += 1;
        }

        if ($has_failed == false) {
            $testdetails->passed = 1;
            $testdetails->passes += 1;
            $testdetails->last_passed = date("Y-m-d H:i:s");
        }

        $testdetails->update();
        return true;
    }

    public function getAdminPath()
    {
        if ($this->isModerator()) {
            return "mod";
        }

        if ($this->isAdministrator()) {
            return "admin";
        }
    }
}
