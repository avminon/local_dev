@extends('sets.home')
@section('title')
    {{ $title }}
@endsection
@section('set_content')


    <div class="list-group">
            <div class="col-md-2">
                {!! Html::image(config()->get('paths.set_image') . $set->image, 'aaa'.$set->id,
                        ['class' => 'thumbnail'])
                !!}
            </div>
            <div class="col-md-10">
                <p><h3><u>{{ $set->name }}</u></h3> (No. of terms added to this set: {{ $set->getCountTerms() }})</p>
                <p>{{ $set->description }}</p>
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
