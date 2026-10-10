@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ __('My Requests') }}

                    @if(auth()->user()->is_admin)
                        <span class="badge bg-danger">
                            Admin - Viewing All Requests
                        </span>
                    @endif
                </div>

                <div class="card-body">

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($requests->count())
                        <a href="{{ route('requests.create') }}"
                           class="btn btn-primary mb-3">
                            Create New Request
                        </a>

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Item Name</th>
                                    <th>Quantity</th>
                                    <th>Status</th>
                                    <th>Created</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($requests as $request)
                                    <tr>
                                        <td>{{ $request->id }}</td>

                                        <td>{{ $request->item_name }}</td>

                                        <td>{{ $request->quantity }}</td>

                                        <td>
                                            <span class="badge bg-warning text-dark">
                                                {{ ucfirst($request->status) }}
                                            </span>
                                        </td>

                                        <td>
                                            {{ $request->created_at
                                                ? $request->created_at->format('M d, Y')
                                                : 'N/A' }}
                                        </td>

                                        <td>
                                            <a href="{{ route('requests.show', $request->id) }}"
                                               class="btn btn-sm btn-info">
                                                View
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{ $requests->links() }}

                    @else
                        <p>No requests found.</p>

                        <a href="{{ route('requests.create') }}"
                           class="btn btn-primary">
                            Create Your First Request
                        </a>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
