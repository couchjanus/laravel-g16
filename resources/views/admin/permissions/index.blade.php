@extends('layouts.admin')

@section('content')

<div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.permissions.create") }}">
                Add New
            </a>
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
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                @forelse ($permissions as $permission)
                
                        <tr>
                            <td>
                                {{ $permission->id }}
                            </td>
                            <td>
                                {{ $permission->name ?? '' }}
                            </td>
                            
                            <td>
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.permissions.show', $permission->id) }}">View</a>
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.permissions.edit', $permission->id) }}">Edit</a>

                                    <form action="{{ route('admin.permissions.destroy',  $permission->id) }}" method="post"  style="display: inline-block;">@method('DELETE') @csrf
                                        <button title="Delete category" type="submit" class="btn btn-xs btn-danger">Delete</button>
                                    </form>  
                            </td>

                        </tr>
                  @empty
                  <p>No permissions yet...</p>
                  @endforelse
                </tbody>
            </table>
            {{ $permissions->links() }}
        </div>
    </div>
</div>

@endsection
