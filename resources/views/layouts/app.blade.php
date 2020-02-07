@extends('layouts.master')

@section('title')
  @parent
     | Home Page
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
  <!-- Custom bady class for this template -->
@endsection

@section('page')

    @include('layouts.partials.app._nav')

    <div id="app">
        @yield('sidebar')
        <!-- Main content -->
        <section class="content">
            @yield('content')
        </section>
        <!-- /.content -->
    </div>

    @include('layouts.partials.app._footer')

@endsection

<!-- Custom scripts for this template -->
@include('layouts.partials.app._scripts')

@push('scripts')
@endpush
