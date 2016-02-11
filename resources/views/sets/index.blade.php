@extends('sets.home')
@section('title')
    {{ $title }}
@endsection
@section('set_content')

    @foreach ($sets as $set)
    <div class="list-group">
            <div class="col-md-2">
                {!! Html::image(config()->get('paths.set_image') . $set->image, 'img'.$set->id,
                        ['class' => 'thumbnail'])
                !!}
            </div>
	    <div class="col-md-2">
                {!! link_to_route('terms.list', 'View', [$set->id]) !!}
                <!-- @if($set->getCountTerms())
                    <br />
                    {!! Form::open(['method' => 'get', 'route' => 'take']) !!}
                        {!! Form::hidden('setName', $set->name) !!}
                        {!! Form::hidden('termCount', $set->getCountTerms()) !!}
                        {!! Form::hidden('setId', $set->id) !!}
                        {!! Form::submit('Take quiz') !!}
                    {!! Form::close() !!}
                @endif -->
            <br />
             @if (($user->isAdmin()) || ($set->user_id == $user->id))
                {!! link_to_route('sets.edit', 'Edit', [$set->id]) !!}
                <br />
                {!! Form::open(['method' => 'delete', 'route' => ['sets.destroy', $set->id]]) !!}
                    {!! Form::submit('Delete') !!}
                {!! Form::close() !!}
            @endif
            </div>
            <div class="col-md-8">
                <p><h3><u>{{ $set->name }}</u></h3> (No. of terms added to this set: {{ $set->getCountTerms() }})</p>
                <p>{{ $set->description }}</p>
            <hr />
            </div>
    </div>
    @endforeach
@endsection
