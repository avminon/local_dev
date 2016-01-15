@extends('app')

@section('title')
    @if (Auth::guest())
        Welcome!
    @endif
    @if (Auth::check())
        Welcome {{$title}}!
    @endif
@endsection


@section('content')
    @if (Auth::check())
                        <div class="panel-heading">Dashboard</div>

                        <div class="panel-body">
                            <div class="col-md-3">
                                <table height="250" border="1px" width="100%">
                                    <tr>
                                        <td></td>
                                    </tr>
                                </table>

                                <h4 align="center">{{ Auth::user()->name }} </h4>
                            </div>
                            <div class="col-md-9">
                                <a href="{{ url('/words') }}" class="btn btn-default btn-lg" role="button">Word</a>
                                <a href="{{ url('/categories') }}" class="btn btn-default btn-lg" role="button">Lesson</a>
                                <h2>Activities</h2>
                                <hr>

                                {{ $activities }}
                            </div>
                        </div>
    @endif
@endsection
