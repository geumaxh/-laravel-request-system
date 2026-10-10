<?php

namespace App\Http\Controllers;

use App\Models\ServiceRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RequestController extends Controller
{
    public function index(Request $request)
    {
        Gate::authorize('viewAny', ServiceRequest::class);

        $query = ServiceRequest::query();

        if (! $request->user()->is_admin) {
            $query->where('user_id', $request->user()->id);
        }

        $requests = $query->latest()->paginate(10);

        return view('requests.index', compact('requests'));
    }

    public function show(ServiceRequest $serviceRequest)
    {
        Gate::authorize('view', $serviceRequest);

        return view('requests.show', compact('serviceRequest'));
    }

    public function store(Request $request)
    {
        Gate::authorize('create', ServiceRequest::class);

        $validated = $request->validate([
            'item_name' => ['required', 'string', 'max:150'],
            'quantity' => ['required', 'integer', 'min:1'],
            'purpose' => ['required', 'string', 'max:2000'],
            'user_id' => ['prohibited'],
            'status' => ['prohibited'],
            'is_admin' => ['prohibited'],
            'role' => ['prohibited'],
        ]);

        ServiceRequest::create([
            'item_name' => $validated['item_name'],
            'quantity' => $validated['quantity'],
            'purpose' => $validated['purpose'],
            'user_id' => $request->user()->id,
            'requester_name' => $request->user()->name,
            'requester_email' => $request->user()->email,
            'status' => 'pending',
        ]);

        return redirect()->route('requests.index')->with('success', 'Request created.');
    }

    public function updateStatus(Request $request, ServiceRequest $serviceRequest)
    {
        Gate::authorize('updateStatus', $serviceRequest);

        $data = $request->validate([
            'status' => ['required', 'in:pending,approved,rejected'],
        ]);

        $serviceRequest->update(['status' => $data['status']]);

        return back()->with('success', 'Status updated.');
    }
}
