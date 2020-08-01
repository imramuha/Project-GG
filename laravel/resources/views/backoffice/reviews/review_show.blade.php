@extends('app')

@section('content')
<div class="jumbotron bg-darklight">

    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2 class="display-4 mb-5">Reviews</h2>
                </div>
                <div class="x_content">
                <table id="datatable-buttons" class="table table-dark table-bordered">
                        <thead class="thead-darklight">
                            <tr>
                                <th>Id</th>
                                <th>Review</th>
                                <th>Score</th>
                                <th>Reviewer</th>
                                <th>Receiver</th>
                                <th>Created at</th>
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
        </div>
    </div>
</div>
@stop