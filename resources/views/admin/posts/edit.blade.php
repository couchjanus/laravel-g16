@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">{{ $title }}</div>

    <div class="card-body">
        <form action="{{ route("admin.posts.update", $post->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
            <label for="title">Title</label>
                <input name="title" class="form-control" type="text" value="{{ $post->title }}" required>
                @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="content">Content</label>
                <textarea name="content" class="form-control" rows="10">{{ $post->content }}</textarea>
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control select2" id="status" name="status">
                    @foreach($status as $key => $value)
                        <option value="{{ $key }}" 
                            @if ($key == $post->status)
                                selected="selected"
                            @endif
                            >{{ $value }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="category_id">Select Category</label>
                <select name="category_id" class="form-control select2">
                    @foreach ($categories as $key => $value)
                        <option value="{{ $key }}"
                            @if ($key == $post->category_id)
                                selected="selected"
                            @endif
                            >{{ $value }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="tag" class= 'control-label'>Select tags</label>
                <select name="tags[]" class="form-control select2" multiple='multiple' id='tag'>
                    @foreach($tags as $key => $value)
                        <option value="{{ $key }}"
                            {{ ($post->tags->pluck('id')->contains($key)) ? 'selected':'' }}  />
                            {{ $value }}
                        </option>
                    @endforeach
                </select>
            </div>


            <div>
                <input class="btn btn-danger" type="submit" value="Update">
            </div>
        </form>
    </div>
</div>
@endsection


@push('scripts')
<script src="{{ asset('js/select2.min.js') }}"></script>

<script>
    $(document).ready(function () {
        $('.select2').select2();
    });
</script>

@endpush