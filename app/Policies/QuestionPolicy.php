<?php

namespace App\Policies;

use App\User;
use App\Question;
use App\Test;
use Illuminate\Auth\Access\HandlesAuthorization;

class QuestionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create questions.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        if ($user->isAdministrator() || $user->isModerator()) {
            // dd("not allowed to add question");
            // abort("Your Not Authorized to Create Question");
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the question.
     *
     * @param  \App\User  $user
     * @param  \App\Question  $question
     * @return mixed
     */
    public function update(User $user, Question $question)
    {
        if ($user->isAdministrator() || ($user->isModerator() AND $user->group_id === $question->test->group_id)) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the question.
     *
     * @param  \App\User  $user
     * @param  \App\Question  $question
     * @return mixed
     */
    public function delete(User $user, Question $question)
    {
        if ($user->isAdministrator() AND $user->group_id === $question->test->group_id) {
            abort("Your Not Authorized to Create Question",404);
            return true;
        }
        return false;
    }
}
