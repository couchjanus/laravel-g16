@extends('layouts.admin')

@section('content')

<div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.roles.create") }}">
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
                @forelse ($roles as $role)
                
                        <tr>
                            <td>
                                {{ $role->id }}
                            </td>
                            <td>
                                {{ $role->name ?? '' }}
                            </td>
                            
                            <td>
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.roles.show', $role->id) }}">View</a>
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.roles.edit', $role->id) }}">Edit</a>

                                    <form action="{{ route('admin.roles.destroy',  $role->id) }}" method="post"  style="display: inline-block;">@method('DELETE') @csrf
                                        <button title="Delete category" type="submit" class="btn btn-xs btn-danger">Delete</button>
                                    </form>  
                            </td>

                        </tr>
                  @empty
                  <p>No roles yet...</p>
                  @endforelse
                </tbody>
            </table>
            {{ $roles->links() }}
        </div>
    </div>
</div>

@endsection
