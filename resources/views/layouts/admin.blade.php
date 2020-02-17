@extends('layouts.master')

@section('title')
@parent
| Admin Dashboard
@endsection

@section('styles')
<!-- Custom styles for this template -->
@include('layouts.partials.admin._styles')
@endsection

@section('meta')
@endsection

@section('body_class')
"sidebar-mini sidebar-open"
@endsection

@section('page')
<div class="wrapper">
    <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
            </li>
        </ul>
        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto">

            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
    </nav>

    @include('layouts.partials.admin._sidebar')

    <div class="content-wrapper" style="min-height: 917px;">
        @include('layouts.partials.admin._flash-message')
        <!-- Main content -->
        <section class="content" style="padding-top: 20px">
            @yield('content')
        </section>
        <!-- /.content -->
    </div>

    <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
            <b>My Site</b> {{ date('Y') }}
        </div>
        <strong> &copy;</strong> All Rights Reserved
    </footer>

</div>

@endsection

@include('layouts.partials.admin._scripts')

@push('scripts')
@endpush
