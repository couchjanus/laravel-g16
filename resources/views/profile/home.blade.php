@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-3 mb-3">
                @include('profile.partials._menu')
            </div>
            <div class="col-sm-9">

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header bg-primary text-white"><h2>Welcome back {{ Auth::user()->name }}!</h2> </div>
                            <div class="card-body">
                                <p class="text-center">
                                    <img class="img-responsive img-thumbnail"
                                        src="{{ 'https://www.gravatar.com/avatar/'.md5(Auth::user()->email).'.png?s=128&d=mm' }}"
                                        alt="Profile Picture"
                                    >
                                </p>
                            </div>
                            <div class="card-footer">
                                To update your profile picture, please visit <a href="https://www.gravatar.com" target="_blank">Gravatar <i class="fa fa-external-link"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header bg-primary text-white">Contact Information</div>
                            <div class="card-body">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif

                                <div class="flash-message">
                                        @foreach (['danger', 'success'] as $message)
                                            @if(Session::has($message))
                                                <p class="alert alert-{{ $message }}">{{ Session::get($message) }}</p>
                                            @endif
                                        @endforeach
                                </div>
            
                                You are logged in!
                                @if(Session::has('username'))
                                    <p class="alert alert">{{ Session::get('username') }} | {{ Session::get('email') }}</p>
                                @endif
                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
