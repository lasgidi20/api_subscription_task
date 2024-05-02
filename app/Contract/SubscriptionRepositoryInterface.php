<?php

namespace App\Contract;

use App\Models\Subscription;

interface SubscriptionRepositoryInterface 
{
    public function getAllSubscriptions();
    public function getSubscriptionById(Subscription $subscription);
    public function deleteSubscription(Subscription $subscription);
    public function createSubscription(array $attributes);
    public function updateSubscription(Subscription $subscription, array $attributes);
}
