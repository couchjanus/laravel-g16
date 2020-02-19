@extends('layouts.admin')

@section('content')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route("admin.index") }}">
            Dashboard
        </a>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h2>{{ $title }}</h2>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            {{-- @if (count($invitations)>0) --}}
            <table class=" table table-bordered table-striped table-hover datatable">
                <thead>
                    <th>Email</th>
                    <th>Created At</th>
                    <th>Invitation Link</th>
                </thead>
                <tbody>
                    @forelse ($invitations as $invitation)
                    <tr>
                        <td>
                            <form action="{{ route('admin.send.invite', ['id' => $invitation->id]) }}" method="post"
                                style="display: inline"> @csrf
                                <button title="Invite user" type="submit"
                                    class="text-white font-bold py-1 px-3 rounded text-xs bg-red-300 hover:bg-red-500">{{ $invitation->email }}</button>
                            </form>
                        </td>
                        <td>{{ $invitation->created_at }}</td>
                        <td>
                            <kbd>{{ $invitation->getLink() }}</kbd>
                        </td>
                    </tr>
                    @empty
                        <p>No invitation requests!</p>
                    @endforelse
                </tbody>
            </table>
            {{-- @else
            <p>No invitation requests!</p>
            @endif
             --}}
        </div>
    </div>
</div>
@endsection
