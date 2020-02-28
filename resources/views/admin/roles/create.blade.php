@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">{{ $title }}</div>

    <div class="card-body">
        <form action="{{ route("admin.roles.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">Name*</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($role) ? $role->name : '') }}">
                @if($errors->has('name'))
                    <p class="help-block">
                        {{ $errors->first('name') }}
                    </p>
                @endif
                <p class="helper-block"></p>
            </div>

            <div class="form-group">
                <label for="name">Permissios</label>
                <select class="form-control select2" id="grid-permissions" name="permissions[]"  multiple='multiple'>
                    @foreach($permissions as $permission)
                    <option value="{{ $permission->id }}">
                        {{ $permission->name }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div>
                <input class="btn btn-danger" type="submit" value="Save">
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