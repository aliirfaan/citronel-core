<?php

namespace  aliirfaan\CitronelCore\Policies\Actor;

use aliirfaan\CitronelCore\Models\Actor\CitronelActor;
use Illuminate\Auth\Access\HandlesAuthorization;

class CitronelActorPolicy
{
    use HandlesAuthorization;
    
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Customer can see only his own resources
     *
     * @param Customer $customer
     * @param $actorId $actorId request token
     *
     * @return void
     */
    public function matchActorToken(CitronelActor $actor, $actorId)
    {
        return $actor->getAuthIdentifier() === $actorId;
    }
}
