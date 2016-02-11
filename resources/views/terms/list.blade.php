@extends('sets.home')
@section('title')
    {{ $title }}
@endsection
@section('set_content')


    <div class="list-group">
            <div class="col-md-2">
                {!! Html::image(config()->get('paths.set_image') . $set->image, 'img'.$set->id,
                        ['class' => 'thumbnail'])
                !!}
            </div>
            <div class="col-md-10">
                <p><h3><u>{{ $set->name }}</u></h3> (No. of terms added to this set: {{ $set->getCountTerms() }})</p>
                <p>{{ $set->description }}</p>
                <p>
                    @if (is_null($studying))
                        {!! Form::open(['method' => 'get', 'route' => ['sets.study']]) !!}
                            {!! Form::hidden('setId', $set->id) !!}
                            {!! Form::submit('STUDY THIS') !!}
                        {!! Form::close() !!}
                    @else
                        {!! Form::open(['method' => 'get', 'route' => ['sets.unstudy']]) !!}
                            {!! Form::hidden('setId', $set->id) !!}
                            {!! Form::submit('UNSTUDY THIS') !!}
                        {!! Form::close() !!}
                    @endif

                <p>
            </div>
    </div>


    <div class="list-group">
            <ul class="list-group col-md-12">
            @foreach ($terms as $term)
                <li class="list-group-item col-md-12">
                        <div class="col-md-6">
                           Q: {{ $term->question }}
                        </div>
                        <div class="col-md-6">
                           A: {{ $term->answer }}
                        </div>
                </li>
        @endforeach
        </ul>
    </div>
@endsection
