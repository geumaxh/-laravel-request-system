@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Request Details') }}</div>

                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label"><strong>Request ID:</strong></label>
                        <p>{{ $serviceRequest->id }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><strong>Requester Name:</strong></label>
                        <p>{{ $serviceRequest->requester_name }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><strong>Requester Email:</strong></label>
                        <p>{{ $serviceRequest->requester_email }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><strong>Item Name:</strong></label>
                        <p>{{ $serviceRequest->item_name }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><strong>Quantity:</strong></label>
                        <p>{{ $serviceRequest->quantity }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><strong>Purpose:</strong></label>
                        <p>{{ $serviceRequest->purpose }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><strong>Status:</strong></label>
                        <p>
                            <span class="badge bg-warning">{{ $serviceRequest->status }}</span>
                        </p>
                    </div>

                    {{-- ADMIN ONLY: Update Status Form --}}
                    @can('updateStatus', $serviceRequest)
                        <hr>
                        <h5>Update Status (Admin Only)</h5>
                        <form method="POST" action="{{ route('requests.updateStatus', $serviceRequest->id) }}">
                            @csrf
                            @method('PATCH')

                            <div class="form-group mb-3">
                                <label for="status" class="form-label">New Status:</label>
                                <select id="status" name="status" class="form-select" required>
                                    <option value="pending" {{ $serviceRequest->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="approved" {{ $serviceRequest->status === 'approved' ? 'selected' : '' }}>Approved</option>
                                    <option value="rejected" {{ $serviceRequest->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-success">Update Status</button>
                        </form>
                    @endcan

                    <div class="mt-3">
                        <a href="{{ route('requests.index') }}" class="btn btn-secondary">Back to List</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection