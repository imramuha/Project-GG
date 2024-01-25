@extends('app')

@section('content')
<div class="container-fluid">
    <div class='mt-2 mb-4'>
        <h2>Reports</h2>
    </div>
    <div class="x_content">
        <table id="datatable-buttons" class="table table-dark table-bordered">
            <thead class="thead-darklight">
                <tr>
                    <th>ID</th>
                    <th>Report Type</th>
                    <th>Type ID</th>
                    <th>Reason</th>
                    <th>Reporter</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reports as $report)
                <tr>
                    <td>{{ $report->id }}</td>
                    <td>{{ $report->type }}</td>
                    <td>{{ $report->type_id }}</td>
                    <td>{{ $report->reason }}</td>
                    <td>{{ $report->user->username }}</td>
                    <td>{{ $report->created_at }}</td>
                    <td><a href="{{ route('reports.delete', $report->id ) }}" class="btn btn-danger btn-xs"><i class="fa fa-pencil" title="Delete"></i>Delete</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection