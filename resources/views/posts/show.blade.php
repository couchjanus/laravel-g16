@extends('layouts.blog')
@section('title')
    @parent
    | {{ $post->title }}
@endsection

@section('content')

<!-- Post Content Column -->
<div class="col-lg-8">

    <!-- Title -->
    <h1 class="mt-4">{{ $post->title }}</h1>

    <!-- Author -->
    <p class="lead">
        by
        <a href="#">{{ $post->user->name }}</a>
    </p>

    <hr>

    <!-- Date/Time -->
    <p>Posted on January {{ $post->created_at }} <span class="float-right">Visits: {{$post->visits}}</span></p>

    <hr>

    <!-- Preview Image -->
    <img class="img-fluid rounded" src="{{ $post->cover_path }}" alt="{{ $post->title }}">

    <hr>

    <!-- Post Content -->
    <p class="lead">{{ $post->content }}</p>
    <p><strong>Categories: </strong> 
    @foreach($post->categories as $cats)
        <a href="" class="badge badge-pill badge-info">{{ $cats->name }}</a>
    @endforeach
     <span class="no-of-comments float-right">Comments: {{ count($post->comments) }}</span>
    </p>
    <hr>
   

    @if (Auth::check())
        <h4>Hello {!! Auth::user()->name !!}!</h4>
        <comment-feed :post-id='{!! $post->id !!}' :user-id='{!! Auth::user()->id !!}'></comment-feed>
    @else
        <comment-feed :post-id='{!! $post->id !!}'></comment-feed>
    @endif  

</div>

@endsection

@push('scripts')
@endpush
