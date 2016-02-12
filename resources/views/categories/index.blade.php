@extends('app')
@section('title')
    {{ $title }}
@endsection
@section('content')
    @if ($user->isAdmin())
        <p>
            {!! link_to_route('categories.create', 'Create new category') !!}
        </p>
    @endif
    @foreach ($categories as $category)
    <div class="list-group">
        <div class="row">
            <div class="col-md-1">
                @if ($user->isAdmin())
                        {!! link_to_route('categories.edit', 'Edit', [$category->id]) !!}
                        {!! Form::open(['method' => 'delete', 'route' => ['categories.destroy', $category->id]]) !!}
                        {!! Form::submit('Delete') !!}
                    {!! Form::close() !!}
                @endif
            </div>
            <div class="col-md-2">
                {!! Html::image(config()->get('paths.category_image') . $category->image, $category->name,
                    ['class' => 'thumbnail'])
                !!}
            </div>
            <div class="col-md-4">
                <p><h3>{{ $category->name }}</h3>
                <p>{{ $category->description }}</p>
            </div>

            <div class="col-md-5">
                <p><strong>Sets Under this Category ({{ $category->getCountSets() }})</strong></p>
                <ul class="list-group">
                    @foreach($category->sets as $set)
                        <li class="list-group-item">{!! link_to('sets/' . $set->id . '/terms/list', $set->name) !!}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <hr />
    @endforeach
@endsection
