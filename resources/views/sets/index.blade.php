@extends('app')
@section('title')
    {{ $title }}
@endsection
@section('content')
    <p>
        {!! link_to_route('sets.create', 'Create new set') !!}
    </p>
    @foreach ($sets as $set)
    <div class="list-group">
            <div class="col-md-2">
                {!! Html::image(config()->get('paths.set_image') . $set->image, $set->name,
                        ['class' => 'thumbnail'])
                !!}
            </div>
            <div class="col-md-8">
                <p><h3><u>{{ $set->name }}</u></h3> (No. of terms added to this set: {{ $set->getCountTerms() }})</p>
                <p>{{ $set->description }}</p>
            </div>
            <div class="col-lft-5">
            {!! link_to_route('terms.list', 'View terms', [$set->id]) !!}
            <br />
             @if (($user->isAdmin()) || ($set->user_id == $user->id))
                {!! link_to_route('terms.create', 'Add new term/s', [$set->id]) !!}
                <br />
                {!! link_to_route('sets.edit', 'Edit', [$set->id]) !!}
                <br />
                {!! Form::open(['method' => 'delete', 'route' => ['sets.destroy', $set->id]]) !!}
                    {!! Form::submit('Delete') !!}
                {!! Form::close() !!}
            @endif
            </div>
    </div>
    @endforeach
@endsection
