<?php

namespace App\Policies;

use App\Models\ServiceRequest;
use App\Models\User;

class ServiceRequestPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true; // Signed-in users can view list
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ServiceRequest $serviceRequest): bool
    {
        return $user->is_admin || $user->id === $serviceRequest->user_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return !$user->is_admin; // Only students can create
    }

    /**
     * Determine whether the user can update status (custom method).
     */
    public function updateStatus(User $user, ServiceRequest $serviceRequest): bool
    {
        return (bool) $user->is_admin; // Only admins can update status
    }
}