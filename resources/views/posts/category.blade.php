@extends('layouts.blog')
@section('title')
@parent
| Search Result
@endsection

@section('content')

    <div class="col-md-8">
            <div class="card">
                <div class="card-header">Category page</div>

                <div class="card-body">

                    <h1>{{ $category->name }}</h1>

                    <ul>
                    @foreach($posts as $post)
                        <li>
                            <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
                        </li>
                    @endforeach
                    </ul>

                </div>
            </div>
    </div>

@endsection
