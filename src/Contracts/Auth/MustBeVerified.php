<?php

namespace aliirfaan\CitronelCore\Auth;

interface MustBeVerified
{
    /**
     * Determine if the user has been verified by some means.
     *
     * @return bool
     */
    public function isVerified();

    /**
     * Mark the given user as verified.
     *
     * @return bool
     */
    public function markAsVerified();

    /**
     * Send the verification notification.
     *
     * @return void
     */
    public function sendVerificationNotification();

    /**
     * Get the field that should be used to send verification message.
     *
     * @return string
     */
    public function getContactDetailForVerification();
}
