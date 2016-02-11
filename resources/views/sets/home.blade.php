@extends('app')
@section('content')
<!--AAA1-->
    <div class="panel-footer col-md-12">
        <div class="col-md-2">
            <div class="panel-body text-center">
                <h4>My Card Sets</h4>
                <ul class="list-group">
                    <li class="list-group-item">
                        {!! link_to_route('sets.create', 'Create new set') !!}
                    </li>
                    <li class="list-group-item">Studying</li>
                    <li class="list-group-item">Created</li>
                </ul>
                <h4>More Sets</h4>
                <ul class="list-group">
                    <li class="list-group-item">Recommended Sets</li>
                    <li class="list-group-item">New Sets</li>
                    <li class="list-group-item">Popular Sets</li>
                </ul>
            </div>
        </div>
        <div class="col-md-8 naid">
<!--ZZZAAA1-->
            @yield('set_content')
<!--AAA2-->
        </div>
        <div class="col-md-2">
            <div class="panel-body text-center">
                <table>
                    <thead>
                        <tr>
                            <th>Mdfsfsdts</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Creasdfsdfds Set</td>
                        </tr>
                        <tr>
                            <td>Stdfsfdsng</td>
                        </tr>
                        <tr>
                            <td>sdffdsfdsf</td>
                        </tr>
                    </tbody>
                </table>
                <hr>
                <table>
                    <thead>
                        <tr>
                            <th>More Sets</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Recommended Sets</td>
                        </tr>
                        <tr>
                            <td>New Sets</td>
                        </tr>
                        <tr>
                            <td>Popular Sets</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<!--ZZZAAA2-->
@endsection
