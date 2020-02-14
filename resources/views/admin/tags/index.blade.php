@extends('layouts.admin')
@section('content')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.tags.create") }}">
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
                    @foreach($tags as $tag)
                        <tr>
                            <td>
                                {{ $tag->id }}
                            </td>
                            <td>
                                {{ $tag->name ?? '' }}
                            </td>
                            
                            <td>
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.tags.show', $tag->id) }}">View</a>
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.tags.edit', $tag->id) }}">Edit</a>

                                    <form action="{{ route('admin.tags.destroy',  $tag->id) }}" method="post"  style="display: inline-block;">@method('DELETE') @csrf
                                        <button title="Delete tag" type="submit" class="btn btn-xs btn-danger">Delete</button>
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