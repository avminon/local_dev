@extends('app')
@section('content')
<!--AAA1-->
    <div class="panel-footer col-md-12">
        <div class="col-md-2">
            <div class="panel-body text-center">
                <h4>My Card Sets</h4>
                <ul class="list-group">
                    <li class="list-group-item">
                        <span class='glyphicon glyphicon-plus'></span>
                        {!! link_to_route('sets.create', 'Create new set') !!}
                    </li>
                    <li class="list-group-item">
                        <span class='glyphicon glyphicon-education'></span>
                        {!! link_to_route('sets.create', 'Studying') !!}
                    </li>
                    <li class="list-group-item">
                        <span class='glyphicon glyphicon-gift'></span>
                        {!! link_to_route('sets.user.created', 'Created', [$user->id]) !!}
                    </li>
                </ul>
                <h4>More Sets</h4>
                <ul class="list-group">
                    <li class="list-group-item">Recommended Sets</li>
                    <li class="list-group-item">{!! link_to_route('sets.user.created', 'New Sets', ['new']) !!}</li>
                    <li class="list-group-item">Popular Sets</li>
                </ul>
            </div>
        </div>
        <div class="col-md-8 naid">
<!--ZZZAAA1-->
            @yield('set_content')
<!--AAA2-->
        </div>
        <div class="col-md-2">
            <div class="panel-body text-center">
                <h4>My Card Sets</h4>
                <ul class="list-group">
                    <li class="list-group-item">
                        {!! link_to_route('sets.create', 'Create new set') !!}
                    </li>
                    <li class="list-group-item">Studying</li>
                    <li class="list-group-item">Created</li>
                </ul>
                <h4>More Sets</h4>
                <ul class="list-group">
                    <li class="list-group-item">Recommended Sets</li>
                    <li class="list-group-item">New Sets</li>
                    <li class="list-group-item">Popular Sets</li>
                </ul>
            </div>
        </div>
    </div>
<!--ZZZAAA2-->
@endsection
