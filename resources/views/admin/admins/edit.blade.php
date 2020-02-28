@extends('layouts.admin')
@section('content')

<div class="card">
  <div class="card-header">{{ $title }}</div>
    <div class="card-body">

        <form action="{{ route('admin.admins.update', $admin->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                <div class="col-md-6">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" required autocomplete="name" autofocus value={{ $admin->name }}>

                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" required autocomplete="email" value={{ $admin->email }}>

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" required autocomplete="new-password" value={{ $admin->password }}>

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="status" class="col-md-4 col-form-label text-md-right">{{ __('Status') }}</label>

                <div class="col-md-6">
                    @foreach($status as $key => $value)
                        <input id='status' type='radio' name='status' data-toggle='switch' data-on-text="{{$value}}" class="form-control @error('status') is-invalid @enderror" required>
                    @endforeach
                    @error('status')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="grid-role" class="col-md-4 col-form-label text-md-right">{{ __('Roles') }}</label>
                <div class="col-md-6">
                    <select class="form-control select2" id="grid-role" name="roles[]"  multiple="multiple">
                        @foreach($roles as $id => $roles)
                            <option class="form-control" value="{{ $id }}" {{ (in_array($id, old('roles', [])) || isset($admin) && $admin->roles->contains($id)) ? 'selected' : '' }}>
                                    {{ $roles }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            
            <div>
                <input class="btn btn-danger" type="submit" value="Update">
            </div>
        </form>
    </div>
</div>
@endsection


@push('scripts')
<script src="{{ asset('js/bootstrap-switch.min.js') }}"></script>
<script src="{{ asset('js/select2.min.js') }}"></script>
<script>
    $(document).ready(function () {
        $('[data-toggle="switch"]').bootstrapSwitch();
        $('.select2').select2();
    });
</script>

@endpush
