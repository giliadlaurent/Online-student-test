<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Group::class)->create([
            'name' => 'admin'
        ])->each(function($g) {
            $g->users()->save(factory(App\User::class)->create([
                'name' => 'Msele',
                'email' => 'admin@mesele.com',
                'password' => bcrypt('udom1234'),
                'group_id' => 1,
                'access_level' => 3,
            ]));
            $g->users()->save(factory(App\User::class)->create([
                'name' => 'instructor',
                'email' => 'udom@gmail.com',
                'password' => bcrypt('udom1234'),
                'group_id' => 1,
                'access_level' => 2,
            ]));
            $g->users()->save(factory(App\User::class)->create([
                'name' => 'Student',
                'email' => 'user@gmail.com',
                'password' => bcrypt('udom1234'),
                'group_id' => 1,
                'access_level' => 1,
            ]));
            $g->tests()->save(factory(App\Test::class)->make());
            $g->tests()->save(factory(App\Test::class)->make());
            $g->tests()->save(factory(App\Test::class)->make());
            $g->tests()->save(factory(App\Test::class)->make());
            $g->tests()->save(factory(App\Test::class)->make());
        });

        factory(App\Group::class, 5)->create()->each(function($g) {
            $g->users()->save(factory(App\User::class)->make());
            $g->users()->save(factory(App\User::class)->make());
            $g->users()->save(factory(App\User::class)->make());
            $g->users()->save(factory(App\User::class)->make());
            $g->users()->save(factory(App\User::class)->make());

            $g->tests()->save(factory(App\Test::class)->make());
            $g->tests()->save(factory(App\Test::class)->make());
            $g->tests()->save(factory(App\Test::class)->make());
            $g->tests()->save(factory(App\Test::class)->make());
            $g->tests()->save(factory(App\Test::class)->make());
        });

        $tests = App\Test::all();
        foreach ($tests as $test) {
            $test->questions()->save(factory(App\Question::class, "single")->make());
            $test->questions()->save(factory(App\Question::class, "single")->make());
            $test->questions()->save(factory(App\Question::class, "single")->make());
            $test->questions()->save(factory(App\Question::class, "double")->make());
            $test->questions()->save(factory(App\Question::class, "double")->make());
            $test->questions()->save(factory(App\Question::class, "double")->make());
        }

        $questions = App\Question::all();
        foreach ($questions as $question) {
            if ($question->multiple_answers_question) {
                $question->options()->save(factory(App\Option::class)->make());
                $question->options()->save(factory(App\Option::class)->make());
                $question->options()->save(factory(App\Option::class)->make([
                    'option' => "This is the correct answer",
                    'correct_answer' => 1,
                ]));
                $question->options()->save(factory(App\Option::class)->make([
                    'option' => "This is the correct answer",
                    'correct_answer' => 1,
                ]));
            } else {
                $question->options()->save(factory(App\Option::class)->make());
                $question->options()->save(factory(App\Option::class)->make());
                $question->options()->save(factory(App\Option::class)->make());
                $question->options()->save(factory(App\Option::class)->make([
                    'option' => "This is the correct answer",
                    'correct_answer' => 1,
                ]));
            }
        }
    }
}