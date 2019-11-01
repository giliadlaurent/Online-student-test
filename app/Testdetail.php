<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Testdetail extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function test()
    {
        return $this->belongsTo(Test::class);
    }

    public function passed()
    {
        if (auth::user() !== $this->user_id) {
            return false;
        } else {
            DB::table('testdetails')->get('passed');
        }
    }
}
