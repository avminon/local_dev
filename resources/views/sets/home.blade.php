@extends('app')
@section('content')
        <div class="col-md-2">
            <div class="panel-body text-center">

                    {!! Form::open(['method' => 'post', 'route' => 'sets.user.search']) !!}

                        {!! Form::hidden('userId', $user->id) !!}
                        {!! Form::text('search_name', '', [
                           'placeholder' => 'Search',
                           'class' => 'form-control'])
                        !!}
                        {!! Form::button('Search',['type'=>'submit','class' => 'btn btn-success']) !!}

                    {!! Form::close() !!}

                <h5>My Card Sets</h5>
                <ul class="list-group">
                    <li class="list-group-item">
                        <span class='glyphicon glyphicon-plus'></span>
                        {!! link_to_route('sets.create', 'Create new set') !!}
                    </li>
                    @if ((!auth()->guest()) && (!($user->isAdmin())))
                    <li class="list-group-item">
                        <span class='glyphicon glyphicon-book'></span>
                        {!! link_to_route('sets.user.list', 'Studying', [$user->id, 'studying']) !!}
                    </li>
                    @endif
                    <li class="list-group-item">
                        <span class='glyphicon glyphicon-gift'></span>
                        {!! link_to_route('sets.user.list', 'Created', [$user->id, 'created']) !!}
                    </li>
                </ul>
                <h5>More Sets</h5>
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
                        {!! link_to_route('sets.user.list', 'Popular Sets', [$user->id, 'popular']) !!}
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-md-8 naid">
            @yield('set_content')
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
@endsection
