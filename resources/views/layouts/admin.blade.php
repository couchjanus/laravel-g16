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
    </nav>

    @include('layouts.partials.admin._sidebar')

    <div class="content-wrapper" style="min-height: 917px;">
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
