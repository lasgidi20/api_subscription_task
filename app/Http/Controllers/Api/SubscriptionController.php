<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contract\SubscriptionRepositoryInterface;
use App\Models\User;
use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;
use App\Notifications\UserSubscription;
use Illuminate\Support\Facades\Notification;
use App\Http\Requests\SubscriptionRequest;

use App\Http\Controllers\Api\BaseController as BaseController;

class SubscriptionController extends BaseController
{
    public function __construct(
        private SubscriptionRepositoryInterface $repository,
    ) { 
    }
    
    public function index()
    {
        $data = $this->repository->getAllSubscriptions();
        
        return $this->sendResponse($data, 'fetched Successfully');
    }

    public function store(SubscriptionRequest $request)
    {
        $attributes = [
            'confirm'=> $request->confirm,
            'user_id'=> $request->user_id,
            'role'=> $request->role
        ];
        $subscription =  $this->repository->createSubscription($attributes);
        $user = User::find($subscription->user_id);
        $success['confirm'] =  $subscription->confirm;
        $success['user_id'] =  $subscription->user_id;
        $messages["hi"] = "Hey, Thank You {$user->firstname}";
        $messages["wish"] = "For subscribing on our platform as a {$user->role}, be sure to receive latest contents as a {$user->role}";
        $user->notify(new UserSubscription($messages));
        return $this->sendResponse($subscription, 'Subscription Successfully Created'); 
    }

    public function show(Subscription $subscription)
    {
        $subscription_item = $this->repository->getSubscriptionById($subscription);

        return $this->sendResponse($subscription_item, 'Subscription Found');
    }

    public function update(Subscription $subscription, SubscriptionRequest $request)
    {
        $subscription_details = $request->only([
            'confirm',
            'role'
        ]);
        $this->repository->updateSubscription($subscription, $subscription_details);

        return $this->sendResponse($subscription, 'Successfully Updated');
    }

    public function destroy(Subscription $subscription)
    {
        $this->repository->deleteSubscription($subscription);

        return $this->sendResponse('Subscription Delete Successfull', 204);
    }
}
