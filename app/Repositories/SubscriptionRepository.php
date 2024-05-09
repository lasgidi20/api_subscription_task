<?php

namespace App\Repositories;

use App\Contract\SubscriptionRepositoryInterface;
use App\Models\Subscription;

class SubscriptionRepository implements SubscriptionRepositoryInterface 
{
    public function getAllSubscriptions() 
    {
        return Subscription::all();
    }

    public function getSubscriptionById($subscriptionId)
    {
        return Subscription::find($subscriptionId);
    }

    public function deleteSubscription($subscriptionId) 
    {
        Subscription::destroy($subscriptionId);
    }

    public function createSubscription(array $attributes) 
    {
        return Subscription::create($attributes);
    }

    public function updateSubscription($subscriptionId, $new_attributes) 
    {
        return Subscription::whereId($subscriptionId)->update($new_attributes);
    }
}

