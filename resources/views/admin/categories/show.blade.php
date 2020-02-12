@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ $title }}
    </div>

    <div class="card-body">
        <table class="table table-bordered table-striped">
            <tbody>
                <tr>
                    <th>
                        Name
                    </th>
                    <td>
                        {{ $category->name }}
                    </td>
                </tr>
                <tr>
                    <th>
                        Description
                    </th>
                    <td>
                        {{ $category->description  ?? 'No description'}}
                    </td>
                </tr>
                <tr>
                    <th>
                        Status
                    </th>
                    <td>
                        {{ \App\Enums\CategoryEnumStatusType::getDescription($category->status) ?? '' }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@endsection