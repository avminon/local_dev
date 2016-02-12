@extends('app')

@section('title')
    Dashboard
@endsection

@section('content')
    <div class="panel-body">
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-body text-center">
                    <table>
                        <tr>
                            <th># of Users</th><td>&nbsp;</td><td>{!! link_to('users/list', count($userList)) !!}</td>
                        </tr>
                        <tr>
                            <th># of Words</th><td>&nbsp;</td><td>{!! link_to('words', count($wordList)) !!}</td>
                        </tr>
                        <tr>
                            <th># of Categories</th><td>&nbsp;</td><td>{!! link_to('categories', count($categoryList)) !!}</td>
                        </tr>
                        <!-- <tr>
                            <th># of Lessons Taken</th><td>&nbsp;</td><td>{{ count($lessonList) }}</td>
                        </tr> -->
                        <tr>
                            <th># of Sets</th><td>&nbsp;</td><td>{!! link_to('sets', count($sets)) !!}</td>
                        </tr>
                    </table>
                </div>
                <div class="panel-footer text-center">
                    {!! link_to('sets/create', 'Add New Set') !!}
                    <br />
                    {!! link_to('categories/create', 'Add New Category') !!}
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <h4>Framgia e-Learning System Statistics:</h4>
        </div>
        <div class="col-md-9">
            <table>
                <tr><td>User with most learned Words:</td><td>&nbsp;</td><td>XXX</td></tr>
                <tr><td>Most learned word:</td><td>&nbsp;</td><td>XXX</td></tr>
                <tr><td>Category with most lessons:</td><td>&nbsp;</td><td>XXX</td></tr>
            </table>

        </div>
    </div>
@endsection
