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
        <div class="list-group-item">
            <table>
                <tr>
                    <td rowspan ='3' colspan='1'>
                        <p>
                            {!! Html::image(config()->get('paths.set_image') . $set->image, $set->name,
                                ['class' => 'thumbnail'])
                            !!}
                        </p>
                    </td>
                    <td>
                         <p><h3><u>{{ $set->name }}</u></h3> (No. of Words added to this set: {{ $set->getCountWords() }})</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>{{ $set->description }}</p>
                    </td>
                </tr>
            @if ($user->isAdmin())
                <tr>
                    <td>
                        {!! link_to_route('sets.edit', 'Edit', [$set->id]) !!}
                        {!! Form::open(['method' => 'delete', 'route' => ['sets.destroy', $set->id]]) !!}
                            {!! Form::submit('Delete') !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endif
            </table>
        </div>
    </div>
    @endforeach
@endsection
