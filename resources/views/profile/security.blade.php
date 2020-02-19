@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                @include('profile.partials._menu')
            </div>
            <div class="col-md-9">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header bg-primary text-white">Update Password</div>
                    <div class="card-body">
                        <form action="{{ route('profile.security.store') }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('put') }}

                            <div class="form-group form-row">
                                <label class="col-form-label col-md-3">Current Password</label>
                                <div class="col-md-9">
                                    <input type="password" class="form-control" name="current_password">
                                </div>
                            </div>

                            <div class="form-group form-row">
                                <label class="col-form-label col-md-3">New Password</label>
                                <div class="col-md-9">
                                    <input type="password" class="form-control" name="password">
                                </div>
                            </div>

                            <div class="form-group form-row">
                                <label class="col-form-label col-md-3">Confirm Password</label>
                                <div class="col-md-9">
                                    <input type="password" class="form-control" name="password_confirmation">
                                </div>
                            </div>

                            <div class="form-group form-row">
                                <div class="col-md-9 offset-md-3">
                                    <button class="btn btn-primary btn-sm">Save Changes</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection