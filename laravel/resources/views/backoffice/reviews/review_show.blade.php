@extends('app')

@section('content')
<div class="container-fluid">
    <div class='mt-2 mb-4'>
        <h2>Reviews</h2>
    </div>
    <div >
        <table id="datatable-buttons" class="table table-dark table-bordered">
            <thead class="thead-darklight">
                <tr>
                    <th>Id</th>
                    <th>Review</th>
                    <th>Score</th>
                    <th>Reviewer</th>
                    <th>Receiver</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reviews as $review)
                <tr>
                    <td>{{ $review['id'] }}</td>
                    <td>{{ $review['comment'] }}</td>
                    <td>{{ $review['score'] }}</td>
                    <td>{{ $review['reviewer']->username }}</td>
                    <td>{{ $review['user']->username }}</td>
                    <td>{{ $review['created_at'] }}</td>
                    <td><a href="{{ route('reviews.delete', ['id' => $review->id]) }}" class="btn btn-danger btn-xs"><i class="fa fa-pencil" title="Delete"></i>Delete</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@stop