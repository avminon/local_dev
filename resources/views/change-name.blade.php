@extends('app')

@section('title')
Change Name
@endsection

@section('content')

<form class="form-horizontal" role="form" method="POST" action="{{ url('/user/update-name') }}">
                       
                        
                        <input type="hidden" name="_token" value="{{ Auth::user()->id }}">
                        <div class="form-group">
                            <label class="col-md-4 control-label">Update Name</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}" required>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">Change</button>

                                <a class="btn btn-link" href="{{ url('/user/'.Auth::id()) }}">Back</a>
                            </div>
                        </div>
                    </form>
@endsection
