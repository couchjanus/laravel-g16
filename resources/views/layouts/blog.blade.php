@extends('layouts.master')

@section('title')
  @parent
     | Blog Page
@endsection

@section('styles')
    <!-- Custom styles for this template -->
    @include('layouts.partials.app._styles')
@endsection

@section('meta')
    <!-- Custom meta for this template -->
    @include('layouts.partials.app._meta')
@endsection

@section('body_class')
    "blog-body"
  <!-- Custom bady class for this template -->
@endsection

@section('page')

    @include('layouts.partials.app._nav')

    <!-- Page Content -->
    <div class="container" id="app">

        <div class="row">
            @yield('content')
            @yield('sidebar')
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->

    @include('layouts.partials.app._footer')

@endsection

<!-- Custom scripts for this template -->
@include('layouts.partials.app._scripts')

@push('scripts')
@endpush
