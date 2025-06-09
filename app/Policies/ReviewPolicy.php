<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Review;

class ReviewPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function delete(User $user, Review $review)
{
    return $user->id === $review->user_id || $user->isAdmin();
}
public function update(User $user, Review $review)
    {
        return $user->id === $review->user_id;
    }
}
