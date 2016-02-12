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
        <div class="col-md-10">
            <p><h3><u>{!! link_to_route('terms.list', $set->name, [$set->id]) !!}</u></h3></p>
            <p>Category: {{ $set->category_name }} (No. of terms added to this set: {{ $set->getCountTerms() }})</p>
            <p>{{ $set->description }}</p>

            <!-- @if($set->getCountTerms())
                <br />
                {!! Form::open(['method' => 'get', 'route' => 'take']) !!}
                    {!! Form::hidden('setName', $set->name) !!}
                    {!! Form::hidden('termCount', $set->getCountTerms()) !!}
                    {!! Form::hidden('setId', $set->id) !!}
                    {!! Form::submit('Take quiz') !!}
                {!! Form::close() !!}
            @endif -->
        <div class="row-fluid">
            <div class="col-md-3">{!! link_to_route('terms.list', 'View', [$set->id]) !!}</div>
                @if (($user->isAdmin()) || ($set->user_id == $user->id))
                    <div class="col-md-4">{!! link_to_route('sets.edit', 'Edit', [$set->id]) !!}</div>
                    <div class="col-md-3">
                    {!! Form::open(['method' => 'delete', 'route' => ['sets.destroy', $set->id]]) !!}
                        {!! Form::submit('Delete') !!}
                    {!! Form::close() !!}
                    </div>
                @endif
        </div>
        <br />
        <hr />
        </div>
    </div>
    @endforeach
@endsection
