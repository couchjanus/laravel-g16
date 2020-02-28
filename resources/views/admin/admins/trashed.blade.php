@extends('layouts.admin')
@section('content')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.admins.index") }}">
                All users
            </a>
            <a class="btn btn-success" href="{{ route("admin.admins.create") }}">
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
                            Status
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>
                                {{ $user->id }}
                            </td>
                            <td>
                                {{ $user->name ?? '' }}
                            </td>
                            <td>
                                {{ \App\Enums\UserStatus::getDescription($user->status) ?? '' }}
                            </td>
                            <td>
                                <form action="{{ route('admin.admins.restore',  $user->id) }}" method="post" style="display: inline">
                                    @csrf
                                    <button title="Restore user" type="submit" class="btn btn-xs btn-primary">Restore</button>
                                </form>    
                                <form action="{{ route('admin.admins.force',  $user->id) }}" method="post" style="display: inline">
                                    @method('DELETE') 
                                    @csrf
                                    <button title="Force Delete user" type="submit" class="btn btn-xs btn-danger">Delete</button>
                                </form>  
                            </td>
                        </tr>
                    @empty
                        <p>No trashed users yet...</p>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
