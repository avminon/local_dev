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
                            <th>Words Learned</th><td>&nbsp;</td><td>{{ count($lessonWords) }}</td>
                        </tr>
                        <tr>
                            <td>
                            <strong>Sets I created({{ count($setsCreated) }})</strong>
                            <br />
                            <ul>
                                @foreach ($setsCreated as $set)
                                    <li>{!! link_to('sets/' . $set->id . '/terms/list', $set->name) !!}</li>
                                @endforeach
                            </ul>
                            </td>
                        </tr>
                        <tr>
                            <td>
                            <strong>Sets I'm studying({{ count($setsStudying) }})</strong>
                            <br />
                            <ul>
                                @foreach ($setsStudying as $set)
                                    <li>{!! link_to('sets/' . $set->id . '/terms/list', $set->name) !!}</li>
                                @endforeach
                            </ul>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <h2>Activities</h2>
            <table class="col-md-9">
                @if (count($activities) == App\Activity::NO_ACTIVITY)
                    <thead><tr>No Activities Found</tr></thead>
                @else
                <thead>
                    <tr>
                        <th class="col-md-3">Date</th>
                        <th class="col-md-6">Activity</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($activities as $activity)

                        <tr>
                            <td>{{ $activity->created_at }}</td>
                            <td>{{ $activity->activity }}</td>
                        </tr>
                    @endforeach
                </tbody>
                @endif
            </table>
        </div>
        <div class="col-mid-2">
            <table>
                <tr>
                    <td>
                    <strong>My Followers({{ count($user->followees) }})</strong>
                    <br />
                    <ul>
                        @foreach ($followers as $follower)
                            <li>{!! link_to('users/show/' . $follower->id, $follower->name) !!}</li>
                        @endforeach
                    </ul>
                    </td>
                </tr>
                <tr>
                    <td>
                    <strong>People I Follow({{ count($user->followers) }})</strong>
                    <br />
                    <ul>
                        @foreach ($followees as $followee)
                            <li>{!! link_to('users/show/' . $followee->id, $followee->name) !!}</li>
                        @endforeach
                    </ul>
                    </td>
                </tr>
            </table>
        </div>
    </div>
@endsection
