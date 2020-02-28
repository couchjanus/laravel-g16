@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">{{ $title }}</div>

    <div class="card-body">
        <form action="{{ route("admin.roles.update", $role->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
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
                <label for="selectall">Permissios: </label> 
                <button type="button" class="btn btn-primary btn-xs" id="selectbtn">
                    Select all
                </button> 
                <button type="button" class="btn btn-primary btn-xs" id="deselectbtn">
                    Deselect all
                </button>
                <select class="form-control select2" id="selectall" name="permissions[]"  multiple='multiple'>
                     @foreach($permissions as $key => $value)
                    <option value="{{ $key }}"
                        {{ ($role->permissions->pluck('id')->contains($key)) ? 'selected':'' }}  />
                            {{ $value }}
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

        $("#selectbtn").click(function(){
            $("#selectall > option").prop("selected","selected");
            $("#selectall").trigger("change");
        });
        $("#deselectbtn").click(function(){
            $("#selectall > option").prop("selected","");
            $("#selectall").trigger("change");
        });


    $(document).ready(function () {
        $('.select2').select2();
    });

</script>

@endpush