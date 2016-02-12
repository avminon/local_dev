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
                        <span class='glyphicon glyphicon-book'></span>
                        {!! link_to_route('sets.user.list', 'Studying', [$user->id, 'studying']) !!}
                    </li>
                    <li class="list-group-item">
                        <span class='glyphicon glyphicon-gift'></span>
                        {!! link_to_route('sets.user.list', 'Created', [$user->id, 'created']) !!}
                    </li>
                </ul>
                <h4>More Sets</h4>
                <ul class="list-group">
                    <li class="list-group-item">
                        <span class='glyphicon glyphicon-thumbs-up'></span>
                        {!! link_to_route('sets.user.list', 'Recommended', [$user->id, 'recommended']) !!}

                    </li>
                    <li class="list-group-item">
                        <span class='glyphicon glyphicon-new-window'></span>
                        {!! link_to_route('sets.user.list', 'New Sets', [$user->id, 'new']) !!}
                    </li>
                    <li class="list-group-item">
                        <span class='glyphicon glyphicon-star'></span>
                        {!! link_to_route('sets.user.list', 'Popular Sets', [$user->id, 'recommended']) !!}
                    </li>
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
                <h4><span class='glyphicon glyphicon-thumbs-up'></span>Recommended Sets</h4>
                <ul class="list-group">
                    @foreach ($recommendedSets as $set)
                    <li class="list-group-item">
                        {!! link_to_route('terms.list', $set->name, [$set->id]) !!}
                    </li>
                    @endforeach
                </ul>
                <h4><span class='glyphicon glyphicon-book'></span>Studying Sets</h4>
                <ul class="list-group">
                    @foreach ($popularSets as $set)
                    <li class="list-group-item">
                        {!! link_to_route('terms.list', $set->name, [$set->id]) !!}
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
<!--ZZZAAA2-->
@endsection
