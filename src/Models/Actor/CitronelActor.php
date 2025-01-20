<?php

namespace aliirfaan\CitronelCore\Models\Actor;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Auth\Events\Verified;
use aliirfaan\CitronelCore\Auth\MustBeActive;
use aliirfaan\CitronelCore\Auth\MustBeVerified;

class CitronelActor extends Model implements AuthenticatableContract, AuthorizableContract, MustBeActive, MustBeVerified
{
    use Authorizable;

    public function getAuthIdentifierName()
    {
        return 'id';
    }

    public function getAuthIdentifier()
    {
        return $this->id;
    }

    public function getActorIdentifier()
    {
        return $this->email;
    }

    public function getActorFullName()
    {
        return $this->full_name;
    }

    public function getAuthPassword()
    {
        return null;
    }

    public function getRememberToken()
    {
        return null;
    }

    public function setRememberToken($value)
    {
        return null;
    }

    public function getRememberTokenName()
    {
        return null;
    }

    public function getAuthPasswordName()
    {
        return null;
    }

    /**
     * @inherit
     */
    public function isActive()
    {
        return intval($this->active);
    }

    /**
     * @inherit
     */
    public function markAsActive()
    {
        return $this->forceFill([
            'active' => 1,
        ])->save();
    }

    /**
     * @inherit
     */
    public function markAsInnactive()
    {
        return $this->forceFill([
            'active' => 0,
        ])->save();
    }

    /**
     * @inherit
     */
    public function isVerified()
    {
        return ! is_null($this->verified_at);
    }

    /**
     * @inherit
     */
    public function markAsVerified()
    {
        $markAsVerified = $this->forceFill([
            'verified_at' => $this->freshTimestamp(),
        ])->save();

        if ($markAsVerified) {
            event(new Verified($this));
            return true;
        }

        return false;
    }

    /**
     * @inherit
     */
    public function getContactDetailForVerification()
    {
        return $this->getActorIdentifier();
    }

    /**
     * @inherit
     */
    public function sendVerificationNotification()
    {
        return null;
    }
}
