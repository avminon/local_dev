@extends('app')
@section('title')
    {{ $title }} for {!! link_to_route('terms.list', $set->name, [$set->id]) !!}
@endsection
@section('content')
    {!! Form::open(['method' => 'post', 'route' => 'terms.store', 'files' => 'true']) !!}
        {{ csrf_field() }}
        <div class="form-group">
            {!! Form::hidden('set_id',$setId) !!}
            {!! Form::text('term_question', '', [
                'required' => 'required',
                'placeholder' => 'Enter question here',
                'class' => 'form-control'])
            !!}
        </div>
        <div class="form-group">
            {!! Form::text('term_answer', '', [
                'required' => 'required',
                'placeholder' => 'Enter answer here',
                'class' => 'form-control'])
            !!}
        </div>

        {!! Form::submit('Add Term and Continue',['name' => 'submit', 'class' => 'btn btn-large btn-success']) !!}
        {!! Form::submit('Add Term',['name' => 'submit', 'class' => 'btn btn-large btn-warning']) !!}
    {!! Form::close() !!}
    {!! Form::open(['method' => 'get', 'route' => ['terms.list', $set->id]]) !!}
        {!! Form::submit('Back',['name' => 'submit', 'class' => 'btn btn-large btn-danger']) !!}
    {!! Form::close() !!}


@endsection
