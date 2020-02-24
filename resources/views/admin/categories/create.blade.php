@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">{{ $title }}</div>

    <div class="card-body">
        <form action="{{ route("admin.categories.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">Name*</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($category) ? $category->name : '') }}">
                @if($errors->has('name'))
                    <p class="help-block">
                        {{ $errors->first('name') }}
                    </p>
                @endif
                <p class="helper-block"></p>
            </div>

            <div class="form-group">
                <label for="parent">Parent Category <span class="m-l-5 text-danger"> *</span></label>
                <select id=parent class="form-control custom-select mt-15 @error('parent_id') is-invalid @enderror" name="parent_id">
                    <option value="0">Select a parent category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"> {{ $category->name }} </option>
                            @foreach($category->children as $cat)
                                <option value="{{ $cat->id }}"> {{ $cat->name }} </option>
                            @endforeach
                        @endforeach
                
                </select>
                @error('parent_id') {{ $message }} @enderror
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control select2" id="status" name="status">
                    @foreach($status as $key => $value)
                        <option value="{{ $key }}">{{$value}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" id="description" name="description" class="form-control" value="{{ old('description', isset($category) ? $category->description : '') }}">
            </div>

            <div>
                <input class="btn btn-danger" type="submit" value="Save">
            </div>
        </form>
    </div>
</div>
@endsection