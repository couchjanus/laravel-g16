@extends('layouts.admin')
@section('content')
    <div style="margin-bottom: 10px;" class="row">
      <div class="col-lg-12">
        <nav class="nav nav-pills flex-column flex-sm-row">
            <a class="text-sm-center nav-link badge badge-success" href="{{ route("admin.users.create") }}">Add New</a>
            <a class="text-sm-center nav-link badge badge-danger" href="{{ route("admin.users.trashed") }}">Trashed Users</a>
            <spam class="flex-sm-fill text-sm-center nav-link">
            <form class="form-inline justify-content-end" action="{{ route('admin.users.search') }}">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="q" value="{{ request('q') }}">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form></spam>
        </nav>
      </div>
    </div>

<div class="card">
    <div class="card-header">
        {{ $title }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable">
                <thead>
                    <tr>
                        <th width="10">
                            Id
                        </th>
                        <th>
                            Name
                        </th>
                        <th>
                            Status
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>
                                {{ $user->id }}
                            </td>
                            <td>
                                {{ $user->name ?? '' }}

                            </td>
                            <td>
                                <input data-id="{{$user->id}}" class="status" type="checkbox" name="switch" {{ ($user->status == 1)? "checked":"" }}>
                            </td>
                            <td>
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.users.show', $user->id) }}">View</a>
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.users.edit', $user->id) }}">Edit</a>

                                    <form action="{{ route('admin.users.destroy',  $user->id) }}" method="post"  style="display: inline-block;">@method('DELETE') @csrf
                                        <button title="Delete user" type="submit" class="btn btn-xs btn-danger">Delete</button>
                                    </form>  
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="{{ asset('js/bootstrap-switch.min.js') }}"></script>

<script>
    $(document).ready(function () {
        $("[name='switch']").bootstrapSwitch();
        
        $.each($("[name='switch']"), function() {
            $(this).bootstrapSwitch('state', $(this).prop('checked') == true ? true : false);
        });

        $("[name='switch']").on('switchChange.bootstrapSwitch', function (e) {
            var status = $(this).prop('checked') == true ? 1 : 0; 
            var user_id = $(this).data('id'); 
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/admin/changeStatus',
                dataType : 'json',
                type: 'POST',
          
                data: {
                    status: status, 
                    user_id: user_id,
                     _token: '{{csrf_token()}}'
                },
            })
            .then(function(data){
                console.log(data.success)
            });
        });

    });
</script>

@endpush
