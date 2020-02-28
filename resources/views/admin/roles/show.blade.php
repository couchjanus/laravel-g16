@extends('layouts.admin')

@section('content')
<div class="container-fluid">
  <div class="animate fadeIn">
    <div class="col-md-9">
      <div class="panel panel-default">
        <div class="panel-heading"><h2>Show permission</h2></div>
          <div class="panel-body">

            <a href="{{ route('admin.permissions.index') }}" class="btn btn-success btn-sm" title="All permissions">
                <i class="fa fa-arrow-left" aria-hidden="true"></i> Go Back
            </a>
            <br/>
            <br/>
            <div class="table-responsive">
              <div class="card">
                <div class="card-header">
                  <b>{{$permission->name}}</b>
                </div>
                <div class="card-footer text-muted">
                  <div class="pull-right">
                    <a title="Edit permission" href="{{ url('admin/permissions/'.$permission->id.'/edit/') }}" class="btn btn-warning"><span class="fa fa-edit"></span></a>
                    <button title="Delete permission" type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete_permission_{{ $permission->id  }}"><span class="fa fa-trash-o"></span></button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>    
  </div>
</div>

<div class="modal fade" id="delete_permission_{{ $permission->id  }}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <form class="" action="{{ route('admin.permissions.destroy', $permission->id) }}" method="post">
    <input type="hidden" name="_method" value="DELETE">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">

    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header bg-red">
          <h4 class="modal-title" id="mySmallModalLabel">Delete permission</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          Are you sure to delete permission: <b>{{ $permission->title }} </b>?
        </div>
        <div class="modal-footer">
          <a href="{{ url('/admin/permissions') }}">
            <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
          </a>
          <button type="submit" class="btn btn-outline" title="Delete" value="delete">Delete</button>
        </div>
      </div>
    </div>
  </form>
</div>

@endsection