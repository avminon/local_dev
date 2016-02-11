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
                {!! Form::file('set') !!}
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
        </div>
        {!! Form::submit('Save') !!}
    {!! Form::close() !!}
    {!! link_to('sets', 'Back') !!}
@endsection
