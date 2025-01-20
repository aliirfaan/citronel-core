<?php

namespace aliirfaan\CitronelCore\Auth;

interface MustBeActive
{
    /**
     * Determine if the user has an active status.
     *
     * @return bool
     */
    public function isActive();

    /**
     * Mark the given user as active.
     *
     * @return bool
     */
    public function markAsActive();

    /**
     * Mark the given user as innactive.
     *
     * @return bool
     */
    public function markAsInnactive();
}
