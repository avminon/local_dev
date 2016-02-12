@extends('app')
@section('title')
    {{ $title }}
@endsection
@section('content')
    {!! Form::open(['method' => 'patch', 'route' => ['sets.update', $set->id], 'files' => 'true']) !!}
        <div class="panel-body">
            <div class="col-md-3">
                {!! Form::hidden('userId',$set->user_id) !!}
                {!! Html::image(config()->get('paths.set_image') . $set->image, 'image'.$set->id,
                            ['class' => 'thumbnail'])
                !!}
                {!! Form::file('set_image') !!}

            </div>
            <div class="col-md-4">
                {!! Form::text('set_name', $set->name, [
                            'required' => 'required',
                            'placeholder' => 'Enter title here',
                            'class' => 'form-control'])
                !!}
                {!! Form::textarea('set_desc', $set->description, [
                            'required' => 'required',
                            'class' => 'form-control'])
                        !!}
            </div>
            <div class="col-md-4">
                <div class="panel-body text-left">
                    <table>
                        <tr>
                            <td>Available to:</td>
                            <td>
                                {!! Form::select('availability', [
                                        '0' => 'Everyone',
                                        '1' => 'Only Me',
                                        '2' => 'My Followers',
                                        '3' => 'Users I Follow',
                                        '4' => 'All Connections'
                                    ], $set->availability)
                                !!}
                            </td>
                        </tr>
                        <tr>
                            <td>Category:</td>
                            <td>{!! Form::select('category', $categories, $set->category_id) !!}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel-footer text-left">
                    Text-to-speech languages:
                    <table>
                        <tr>
                            <td>Question:</td>
                            <td>{!! Form::select('questionLanguage', $categories, $set->question_language) !!}</td>
                        </tr>
                        <tr>
                            <td>Answer:</td>
                            <td>{!! Form::select('answerLanguage', $categories, $set->answer_language) !!}</td>
                        </tr>
                    </table>

                </div>
            </div>
            <div class="col-md-4">
                <div class="panel-footer text-left">
                    Metrics:
                    <table>
                        <tr>
                            <td># of Studying:&nbsp;{{ $set->getCountStudying() }}</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td># of Terms:&nbsp;{{ $set->getCountTerms() }}</td>
                            <td>&nbsp;</td>
                        </tr>
                    </table>

                </div>
            </div>
        </div>
    {!! Form::submit('Save',['name' => 'submit', 'class' => 'btn btn-large btn-success']) !!}&nbsp;{!! link_to('sets', 'Cancel',['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}


<hr />
    <div class="panel-body">
        <div class="col-md-12"><h5>Add New Term</h5>
            {!! Form::open(['method' => 'post', 'route' => 'terms.store', 'files' => 'true']) !!}
                {{ csrf_field() }}
                <div class="form-group">
                    {!! Form::hidden('set_id',$set->id) !!}
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

                {!! link_to('sets', 'Cancel',['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}
        </div>
    </div>
    <hr />
    <div class="panel-body">
        <div class="col-md-12"><h5>Terms List</h5>
            <div class="list-group">
                    <ul class="list-group col-md-12">
                    @foreach ($terms as $term)
                        <li class="list-group-item col-md-12">
                                <div class="col-md-1">
                                        {!! Form::open(['method' => 'delete', 'route' => ['terms.destroy', $term->id]]) !!}
                                            {!! Form::submit('x',['class'=>'btn btn-danger']) !!}
                                        {!! Form::close() !!}
                                </div>
                                <div class="col-md-5">
                                    Q: {{ $term->question }}
                                </div>
                                <div class="col-md-6">
                                   A: {{ $term->answer }}
                                </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

    </div>
@endsection
