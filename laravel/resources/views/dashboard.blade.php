@extends('app')

@section('content')

<div>Dashboard</div>
<div class="jumbotron bg-darklight">

    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2 class="display-4 mb-5">Reports</h2>
                </div>
                <div class="x_content">
                <table id="datatable-buttons" class="table table-dark table-bordered">
                        <thead class="thead-darklight">
                            <tr>
                                <th>ID</th>
                                <th>Report Type</th>
                                <th>Type ID</th>
                                <th>Reason</th>
                                <th>Reported by</th>
                                <th>Reported at</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($reports as $report)                       
                            <tr>
                            <td>{{ $report->id }}</td>
                            <td>{{ $report->type }}</td>
                            <td>{{ $report->type_id }}</td>
                            <td>id: {{ $report->reason }}</td>
                            <td>{{ $report->user->username }}</td>
                            <td>{{ $report->created_at }}</td>
                                <td><a href="{{ route('reports.delete', $report->id ) }}" class="btn btn-danger btn-xs"><i class="fa fa-pencil" title="Delete"></i>Delete</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
             </div>
        </div>
    </div>
</div>
@endsection
