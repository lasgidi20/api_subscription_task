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

    public function getSubscriptionById(Subscription $subscription) 
    {
        return $subscription;
      //  public function getSubscriptionById(Subscription $subscription) 
      //  return Subscription::findorfail($subscriptionId)
    }

    public function deleteSubscription(Subscription $subscription) 
    {
        $subscription->delete();
         //  public function deleteById($subscriptionid) 
      //  Subscription::destroy($subscriptionId)
    }

    public function createSubscription(array $attributes) 
    {
        return Subscription::create($attributes);
    }

    public function updateSubscription(Subscription $subscription, array $attributes) 
    {
        return $subscription->update($attributes);
        // return Subscription::whereId($subscriptionId)->update($newDetails);
    }
}
