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

            <div class="mx-auto" style="width: 30%;"><img src="{{ $post->cover_path }}"></div>

              <div class="mx-auto uploader">
                <input id="file-upload" type="file" name="cover" accept="image/*" onchange="readURL(this);">
                <label for="file-upload" id="file-drag">
                    <img id="file-image" src="#" alt="Preview" class="hidden">
                    <div id="start">
                        <i class="fas fa-download" aria-hidden="true"></i>
                        <div>Change This Image</div>
                        <div id="notimage" class="hidden">Please select an image</div>
                        <span id="file-upload-btn" class="btn btn-primary">Select a file</span>
                        <br>
                        <span class="text-danger">{{ $errors->first('cover') }}</span>
                    </div>
                </label>
              </div>
            </div>
            <br><hr>

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
                <label>Select Category</label>
                <select name="categories[]" multiple class="form-control select2">
                    @foreach($categories as $key => $value)
                        <option value="{{ $key }}"
                            {{ ($post->categories->pluck('id')->contains($key)) ? 'selected':'' }}  />
                            {{ $value }}
                        </option>
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
    
    function readURL(input, id) {
        id = id || '#file-image';
        
        if (input.files && input.files[0]) {
            var reader = new FileReader();
    
            reader.onload = function (e) {
                $(id).attr('src', e.target.result);
            };
    
            reader.readAsDataURL(input.files[0]);
            $('#file-image').removeClass('hidden');
            $('#start').hide();
        }
    }
</script>

@endpush