<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function deleteOption()
    {
        $this->delete();
        return true;
    }

    public function addOption($question, $optionData)
    {
        $this->option = $optionData["option"];
        if (array_key_exists("correct_answer", $optionData)) {
            $this->correct_answer = 1;
        } else {
            $this->correct_answer = 0;
        }
        $question->options()->save($this);
    }

    public function updateOption($optionData)
    {
        $this->option = $optionData["option"];
        if (array_key_exists("correct_answer", $optionData)) {
            $this->correct_answer = 1;
        } else {
            $this->correct_answer = 0;
        }
        $this->update();
    }
}
