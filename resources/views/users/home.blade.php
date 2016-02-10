@extends('app')

@section('title')
    {{ trans('common.users.home.panel_label') }}
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
                <div class="panel-footer text-center">
                    <table>
                        <tr>
                            <th>Words Learned</th><td>&nbsp;</td><td>{{ count($lessonWords) }}</td>
                        </tr>
                        <tr>
                            <th>Followers</th><td>&nbsp;</td><td>{{ count($user->followees) }}</td>
                        </tr>
                        <tr>
                            <th>Following</th><td>&nbsp;</td><td>{{ count($user->followers) }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-9">
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
            <hr>
        </div>
    </div>
@endsection
