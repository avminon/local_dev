@extends('app')

@section('title')
    {{ $title }}
@endsection

@section('content')
    <div class="panel-body">
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-body text-center">
                    <table>
                        <tr>
                            <td>
                                {!! Html::image(config()->get('paths.user_image') . $user->avatar, $user->name, [
                                        'class' => 'thumbnail',
                                        'alt' => $user->name,
                                        'title' => $user->name
                                    ])
                                !!}
                            </td>
                            <td>{{ $user->name }}</td>
                        </tr>
                    </table>
                </div>
                <div class="panel-footer text-left">
                    <table>
                        <tr>
                            <td>
                            <strong>Sets I created({{ count($setsCreated) }})</strong>
                            <br />
                            <ul class="list-group">
                                @foreach ($setsCreated as $set)
                                    <li class="list-group-item">{!! link_to('sets/' . $set->id . '/terms/list', $set->name) !!}</li>
                                @endforeach
                            </ul>
                            </td>
                        </tr>
                        <tr>
                            <td>
                            <strong>Sets I'm studying({{ count($setsStudying) }})</strong>
                            <br />
                            <ul class="list-group">
                                @foreach ($setsStudying as $set)
                                    <li class="list-group-item">{!! link_to('sets/' . $set->id . '/terms/list', $set->name) !!}</li>
                                @endforeach
                            </ul>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <h3>Activities</h3>
            @if (count($activities) == App\Activity::NO_ACTIVITY)
            {!!  trans('common.users.no_activities_found') !!}
            @else
                <table class="col-md-9">
                    <thead>
                        <tr>
                            <th class="col-md-3">Date</th>
                            <th class="col-md-6">Activity</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($activities as $activity)
                        <tr>
                            <td>
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        {{ $activity->created_at }}
                                    </li>
                                </ul>
                            </td>
                            <td>
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        {{ $activity->activity }}
                                    </li>
                                </ul>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
        <div class="col-mid-2">
            <table>
                <tr>
                    <td>
                    <strong>My Followers({{ count($user->followees) }})</strong>
                    <br />
                    <ul class="list-group">
                        @foreach ($followers as $follower)
                            <li class="list-group-item">{!! link_to('users/show/' . $follower->id, $follower->name) !!}</li>
                        @endforeach
                    </ul>
                    </td>
                </tr>
                <tr>
                    <td>
                    <strong>People I Follow({{ count($user->followers) }})</strong>
                    <br />
                    <ul class="list-group">
                        @foreach ($followees as $followee)
                            <li class="list-group-item">{!! link_to('users/show/' . $followee->id, $followee->name) !!}</li>
                        @endforeach
                    </ul>
                    </td>
                </tr>
            </table>
        </div>
    </div>
@endsection
