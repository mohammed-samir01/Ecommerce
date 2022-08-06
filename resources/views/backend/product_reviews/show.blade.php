@extends('layouts.admin')
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">Product Reviews</h6>
            <div class="ml-auto">
                <a href="{{ route('admin.product_reviews.index') }}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-plus"></i>
                    </span>
                    <span class="text">Reviews</span>
                </a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table">
                <tbody>
                <tr>
                    <th>Name</th>
                    <td>{{ $productReview->name }}</td>
                    <th>Email</th>
                    <td>{{ $productReview->email }}</td>
                </tr>
                <tr>
                    <th>Customer Name</th>
                    <td>{{ $productReview->user_id != '' ? $productReview->user->name : '' }}</td>
                    <th>Rating</th>
                    <td>{{ $productReview->rating }}</td>
                </tr>
                <tr>
                    <th>Title</th>
                    <td colspan="3">{{ $productReview->title }}</td>
                </tr>
                <tr>
                    <th>Message</th>
                    <td colspan="3">{{ $productReview->message }}</td>
                </tr>
                <tr>
                    <th>Created date</th>
                    <td colspan="3">{{ $productReview->created_at->format('Y-m-d') }}</td>
                </tr>
                </tbody>
            </table>
        </div>

@endsection
