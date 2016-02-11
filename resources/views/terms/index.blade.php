@extends('sets.home')
@section('title')
    {{ $title }}
@endsection
@section('set_content')
    @foreach ($terms as $term)
    <div class="list-group">
            <div class="col-md-2">ddd
                {!! $term->set_id !!}
            </div>
            <div class="col-md-10">
                <p><h3><u>{{ $term->question }}</u></h3></p>
                <p>{{ $term->answer }}</p>
            </div>
    </div>
    @endforeach
@endsection
