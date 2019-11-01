@extends('layouts.base') @section('content')

<div class="container-fluid">
    <div class="col-md-6 col-md-offset-3">
        @include('shared.session-flash') @include('shared.validation-errors')
      <div class="panel panel-default">
          <div class="panel-heading">
              <h3 class="panel-title">Edit Question</h3>
          </div>
          <div class="panel-body">
                 <form method="POST" action="/{{ Auth::user()->getAdminPath() }}/questions/{{ $question->id }}">
            {{ csrf_field() }} {{ method_field('PATCH') }}
            <div class="form-group">
                <label>Title</label>
                <input
                    type="text"
                    class="form-control"
                    name="title"
                    value="{{ $question->title }}"
                    required
                    maxlength="255"
                />
            </div>
            <div class="form-group">
                <label>Question</label>
                <textarea class="form-control" name="question" rows="5" required>{{ $question->question }}</textarea>
            </div>
            <div class="form-group">
                <label>Multiple Answers Required</label>
                <select class="form-control" name="multiple_answers_question">
                    <option value="0" @if ($question->multiple_answers_question == 0) selected @endif>No</option>
                    <option value="1" @if ($question->multiple_answers_question == 1) selected @endif>Yes</option>
                </select>
            </div>
            <div class="option-wrap">
                @for ($i = 1; $i < count($options)+1; $i++)
                <div class="form-group option-field-{{ $i }}">
                    <label>Option #{{ $i }}</label>
                    <input
                        class="pull-right"
                        type="checkbox"
                        name="options[{{ $i }}][correct_answer]"
                        value="1"
                        @if($options[$i-1]->correct_answer == 1) checked @endif \>
                    <span class="pull-right" style="padding:2px;">Correct Answer</span>
                    <input
                        type="text"
                        class="form-control"
                        name="options[{{ $i }}][option]"
                        value="{{ $options[$i-1]->option }}"
                        required
                        maxlength="255"
                    />
                </div>
                @endfor
            </div>
            <button type="submit" class="btn btn-primary pull-left">Submit</button>
        </form>
        <button class="add-option pull-right btn btn-default">Add More Fields</button>
        <button class="remove-option pull-right btn btn-default">Remove Fields</button>
          </div>
      </div>
    </div>
</div>

@stop