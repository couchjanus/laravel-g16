@extends('layouts.blog')
@section('title')
@parent
| All Posts
@endsection

@section('content')

<!-- Blog Entries Column -->
<div class="col-md-8">

    <h1 class="my-4">{{ $title }}
        <small>Secondary Text</small>
    </h1>

    @forelse($posts as $post)
        <!-- Blog Post -->
    <div class="card mb-4">
        <img class="card-img-top" src="{{$post->cover_path}}" alt="Card image cap">
        <div class="card-body">
            <a href="{{route('blog.show', $post->slug)}}"><h2 class="card-title">{{$post->title}}</h2></a>
            <p class="card-text">{{$post->description}}</p>
            <a href="{{route('blog.show', $post->slug)}}" class="btn btn-primary">Read More &rarr;</a>
        </div>
        <div class="card-footer text-muted">
            Posted on {{$post->created_at}} by: 
            <a href="#">{{$post->user->name}}</a>
            <span class="float-right">Visits: {{$post->visits}}</span>
        </div>
    </div>
            
    @empty
        <p>No posts yet...</p>
    @endforelse
    <!-- Blog Post -->
    

    <!-- Pagination -->
    <ul class="pagination justify-content-center mb-4">
        {{ $posts->links() }}
    </ul>

</div>

@endsection

@push('scripts')
@endpush
