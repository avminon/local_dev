@extends('app')

@section('title')
Change Password
@endsection

@section('content')

<form class="form-horizontal" role="form" method="POST" action="{{ url('/user/update-password') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group">
                            <label class="col-md-4 control-label">Old Password</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" name="oldpassword" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">New Password</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" name="newpassword">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Confirm Password</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" name="confirmpassword">
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
