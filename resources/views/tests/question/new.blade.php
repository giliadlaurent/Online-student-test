@extends('layouts.base') @section('content')
<div class="container-fluid">
    <div class="col-md-6 col-md-offset-3">
        @include('shared.session-flash') @include('shared.validation-errors')
        <h1></h1>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Question {{ $question_number }}</h3>
            </div>
            <div class="panel-body">
                    
                <form method="POST" action="{{ action('AdministrativeTestController@addQuestion',$test->id) }}" id="form1">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" name="title" required maxlength="255" />
                    </div>
                    <div class="form-group">
                        <label>Question</label>
                        <textarea class="form-control" name="question" rows="5" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Multiple Answers Required</label>
                        <select class="form-control" name="multiple_answers_question">
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                        </select>
                    </div>
                    <div class="option-wrap">
                        @for ($i = 1; $i < 5; $i++)
                        <div class="form-group option-field-{{ $i }}">
                            <label>Option #{{ $i }}</label>
                            <input
                                class="pull-right"
                                type="checkbox"
                                name="options[{{ $i }}][correct_answer]"
                                value="1"
                            />
                            <span class="pull-right">Correct Answer</span>
                            <input
                                type="text"
                                class="form-control"
                                name="options[{{ $i }}][option]"
                                required
                                maxlength="255"
                            />
                        </div>
                        @endfor
                    </div>
                    <button type="submit" class="btn btn-primary pull-left" form="form1">Submit</button>
                </form>
                <button class="add-option pull-right btn btn-default">Add More Fields</button>
                <button class="remove-option pull-right btn btn-default">Remove Fields</button>
            </div>
        </div>
    </div>
</div>

@stop