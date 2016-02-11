@extends('app')
@section('title')
    {{ $title }}
@endsection
@section('content')
    {!! Form::open(['method' => 'post', 'route' => 'sets.store', 'files' => 'true']) !!}
        {{ csrf_field() }}
        <div class="form-group">
            {!! Form::hidden('userId',$user->id) !!}
            {!! Form::text('set_name', '', [
                'required' => 'required',
                'placeholder' => 'Enter title here',
                'class' => 'form-control'])
            !!}
            {!! Form::file('set_image') !!}
        </div>
        <div class="form-group">
            {!! Form::textarea('set_desc', '', [
                'required' => 'required',
                'placeholder' => 'About this set',
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
                                ])
                            !!}
                        </td>
                    </tr>
                    <tr>
                        <td>Category:</td>
                        <td>{!! Form::select('category', $categories) !!}</td>
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
                        <td>{!! Form::select('questionLanguage', $categories) !!}</td>
                    </tr>
                    <tr>
                        <td>Answer:</td>
                        <td>{!! Form::select('answerLanguage', $categories) !!}</td>
                    </tr>
                </table>

            </div>
        </div>
        {!! Form::submit('Add set') !!}
    {!! Form::close() !!}
@endsection
