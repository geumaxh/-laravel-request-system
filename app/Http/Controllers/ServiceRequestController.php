<?php

namespace App\Http\Controllers;

use App\Models\ServiceRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class ServiceRequestController extends Controller
{
    /**
     * Display a listing of requests.
     * Students see only their own; admins see all.
     */
    public function index()
    {
        // Check authorization
        Gate::authorize('viewAny', ServiceRequest::class);

        // If student: scope by user_id. If admin: get all.
       if (auth()->user()->role === 'admin') {
            $requests = ServiceRequest::paginate(10);
        } else {
            $requests = ServiceRequest::where('user_id', auth()->user()->id)->paginate(10);
        }

        return view('requests.index', ['requests' => $requests]);
    }

    /**
     * Show the form for creating a new request.
     */
    public function create()
    {
        // Only students can create
        Gate::authorize('create', ServiceRequest::class);

        return view('requests.create');
    }

    /**
     * Store a newly created request in database.
     * Server-side validation and trusted field assignment.
     */
   public function store(Request $request)
{
    // Validate input - prohibit spoofed fields
    $validated = $request->validate([
        'item_name' => 'required|string|max:150',
        'quantity' => 'required|integer|min:1',
        'purpose' => 'required|string|max:2000',
        'user_id' => 'prohibited',
        'status' => 'prohibited',
        'is_admin' => 'prohibited',
        'role' => 'prohibited',
    ]);

    // Assign trusted fields from authenticated user
    $validated['user_id'] = auth()->user()->id;
    $validated['requester_name'] = auth()->user()->name;
    $validated['requester_email'] = auth()->user()->email;
    $validated['status'] = 'pending';

    // Create the request
    ServiceRequest::create($validated);

    return redirect()->route('requests.index')->with('success', 'Request created successfully.');
}

    /**
     * Display the specified request.
     */
    public function show(ServiceRequest $serviceRequest)
    {
        // Check authorization: owner or admin only
        Gate::authorize('view', $serviceRequest);

        return view('requests.show', ['serviceRequest' => $serviceRequest]);
    }

    /**
     * Update the status of a request (admin only).
     */
    public function updateStatus(Request $request, ServiceRequest $serviceRequest)
    {
        // Check authorization BEFORE validation
        Gate::authorize('updateStatus', $serviceRequest);

        // Validate the new status
        $validated = $request->validate([
            'status' => 'required|string|in:pending,approved,rejected',
        ]);

        // Update ONLY the status field
        $serviceRequest->update(['status' => $validated['status']]);

        return redirect()->route('requests.show', $serviceRequest->id)->with('success', 'Status updated successfully.');
    }
}