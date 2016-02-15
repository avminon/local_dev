@extends('app')

@section('title')
    {{ trans('common.users.available_users') }}
@endsection

@section('content')
    <div class="panel-body">
        <div class="col-md-12">
            {!! Form::open(['method' => 'get', 'route' => ['users.filter']]) !!}
                {!!
                    Form::text('user')
                !!}
                {!! Form::radio('status', 'followed', $status == App\Word::STATUS_LEARNED) !!}
                {!! Form::label('followed', 'Followed') !!}
                {!! Form::radio('status', 'notfollowed', $status == App\Word::STATUS_UNLEARNED) !!}
                {!! Form::label('notfollowed', 'Not Followed') !!}
                {!! Form::radio('status', 'all', $status == App\Word::STATUS_ALL) !!}

                {!! Form::label('all', 'All') !!}
                {!! Form::submit('Filter') !!}
            {!! Form::close() !!}
            <br />
            <table class="col-md-12">
                <thead>
                    <tr>
                        <th class="col-md-1">&nbsp;</th>
                        <th class="col-md-5">Name</th>
                        <th class="col-md-3">Details</th>
                        <th class="col-md-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($usersList as $followedUser)
                        @if (!($followedUser->isAdmin()))
                        <tr>
                            <td>
                                {!! Html::image(config()->get('paths.user_image') . $followedUser->avatar,
                                    $followedUser->name, [
                                        'class' => 'thumbnail'
                                    ])
                                !!}
                            </td>
                            <td>
                                <ul class="list-group">
                                <li class="list-group-item">
                                    {!! link_to('users/show/' . $followedUser->id,$followedUser->name) !!}
                                </li>
                                <li class="list-group-item">{{ $followedUser->email }}</li>
                                </ul>
                            </td>
                            <td>
                                <ul class="list-group">
                                <li class="list-group-item">Followers: {{ count($followedUser->followees) }}</li>
                                <li class="list-group-item">Following: {{ count($followedUser->followers) }}</li>
                                </ul>
                            </td>
			                 @if (!($user->isAdmin()))
                            <td>
                                @if (in_array($followedUser->id, $follows))
                                <ul class="list-group">
                                    <li class="list-group-item">
                                    {!! Form::open(['method' => 'get', 'route' => [
                                            'user.unfollow',
                                            $followedUser->id
                                        ]])
                                    !!}
                                        {!! Form::submit('Unfollow', ['class' => 'btn btn-danger']) !!}
                                    {!! Form::close() !!}<br />
                                    </li>
                                </ul>
                                @else
                                <ul class="list-group">
                                    <li class="list-group-item">
                                    {!! Form::open(['method' => 'get', 'route' => [
                                            'user.follow',
                                            $followedUser->id
                                        ]])
                                    !!}
                                        {!! Form::submit('Follow', ['class' => 'btn btn-success']) !!}
                                    {!! Form::close() !!}<br />
                                    </li>
                                </ul>
                                @endif
                            </td>
                            @else
                            <td>
                                <ul class="list-group">
                                <li class="list-group-item">
                                    {!! link_to('users/show/' . $followedUser->id,'View') !!}
                                    {!! link_to_route('users.edit', 'Edit', $followedUser->id) !!}
                                </li>
                                <li class="list-group-item">
                                    {!! link_to_route('users.destroy', 'Delete', $followedUser->id) !!}
                                </li>
                                </ul>
                            </td>
                            @endif
                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
            <hr>
        </div>
    </div>
@endsection
