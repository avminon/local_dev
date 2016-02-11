@extends('app')
@section('title')
    {{ $title }}
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="panel-heading">Question # {{ (session()->get('questionIndex') + 1) }}</div>
        <div class="panel-body">
            <div class="col-md-10">
                <div class="panel-body">
                    <div class="col-md-6">
                        <b><h1>Term</h1></b>
                        <p>
                        </p>
                    </div>
                    <div class="col-md-6">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
