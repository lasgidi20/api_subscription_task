<?php

namespace App\Contract;

use App\Models\Subscription;

interface SubscriptionRepositoryInterface 
{
    public function getAllSubscriptions();
    public function getSubscriptionById($subscriptionId);
    public function deleteSubscription($subscriptionId);
    public function createSubscription(array $attributes);
    public function updateSubscription($subscriptionId, array $new_attributes);
}
