@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                @include('profile.partials._menu')
            </div>
            <div class="col-sm-9">
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
                    <div class="card-header bg-danger text-white">Delete Account</div>
                    <div class="card-body">
                        <form action="{{ route('profile.remove') }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('delete') }}

                            <div class="form-group form-row">
                                <div class="col-md-9 offset-md-3">
                                    <p class="lead">Are you sure?</p>
                                    <a href="{{ route('profile') }}" class="btn btn-primary btn-sm">No, I changed my mind!</a>
                                    <button class="btn btn-danger btn-sm">Yes, delete my account.</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection