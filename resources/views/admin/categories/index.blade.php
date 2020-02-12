@extends('layouts.admin')
@section('content')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.categories.create") }}">
                Add New
            </a>
            <a class="btn btn-warning" href="{{ route("admin.categories.trashed") }}">
                Trashed Categories
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
                    @foreach($categories as $key => $category)
                        <tr>
                            <td>
                                {{ $category->id }}
                            </td>
                            <td>
                                {{ $category->name ?? '' }}
                            </td>
                            <td>
                                {{ \App\Enums\CategoryEnumStatusType::getDescription($category->status) ?? '' }}
                            </td>
                            <td>
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.categories.show', $category->id) }}">View</a>
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.categories.edit', $category->id) }}">Edit</a>

                                    <form action="{{ route('admin.categories.destroy',  $category->id) }}" method="post"  style="display: inline-block;">@method('DELETE') @csrf
                                        <button title="Delete category" type="submit" class="btn btn-xs btn-danger">Delete</button>
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

@section('scripts')
@parent

@endsection