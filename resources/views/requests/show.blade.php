
@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Request Details</h1>

    {{-- Success message after updating status --}}
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    {{-- Validation errors --}}
    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Request information --}}
    <div class="card mb-3">
        <div class="card-body">

            <p>
                <strong>Request ID:</strong>
                {{ $serviceRequest->id }}
            </p>

            <p>
                <strong>Requester Name:</strong>
                {{ $serviceRequest->requester_name }}
            </p>

            <p>
                <strong>Requester Email:</strong>
                {{ $serviceRequest->requester_email }}
            </p>

            <p>
                <strong>Item Name:</strong>
                {{ $serviceRequest->item_name }}
            </p>

            <p>
                <strong>Quantity:</strong>
                {{ $serviceRequest->quantity }}
            </p>

            <p>
                <strong>Purpose:</strong>
                {{ $serviceRequest->purpose }}
            </p>

            <p>
                <strong>Current Status:</strong>
                {{ ucfirst($serviceRequest->status) }}
            </p>

            
<p>
    <strong>Date Submitted:</strong>
    {{ $serviceRequest->created_at
        ? $serviceRequest->created_at->format('M d, Y h:i A')
        : 'Not available' }}
</p>


        </div>
    </div>

    {{-- Admin status update form --}}
    @can('updateStatus', $serviceRequest)
        <div class="card mb-3">
            <div class="card-header">
                Update Request Status
            </div>

            <div class="card-body">
                <form method="POST"
                      action="{{ route('requests.updateStatus', $serviceRequest) }}">

                    @csrf
                    @method('PATCH')

                    <div class="mb-3">
                        <label for="status" class="form-label">
                            Select Status
                        </label>

                        <select name="status"
                                id="status"
                                class="form-select"
                                required>

                            <option value="pending"
                                {{ $serviceRequest->status === 'pending' ? 'selected' : '' }}>
                                Pending
                            </option>

                            <option value="approved"
                                {{ $serviceRequest->status === 'approved' ? 'selected' : '' }}>
                                Approved
                            </option>

                            <option value="rejected"
                                {{ $serviceRequest->status === 'rejected' ? 'selected' : '' }}>
                                Rejected
                            </option>

                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        Update Status
                    </button>

                </form>
            </div>
        </div>
    @endcan

    <a href="{{ route('requests.index') }}" class="btn btn-secondary">
        Back to Requests
    </a>

</div>
@endsection
