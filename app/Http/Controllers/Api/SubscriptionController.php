<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contract\SubscriptionRepositoryInterface;
use App\Contract\MessageRepositoryInterface;
use Illuminate\Http\JsonResponse;
use App\Models\User;
use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;
use App\Notifications\UserSubscription;
use App\Http\Middleware\CheckRole;
use App\Http\Requests\SubscriptionRequest;
use App\Http\Middleware\isAuthenticated;
use Validator;
use App\Http\Controllers\Api\BaseController as BaseController;

class SubscriptionController extends BaseController
{
    public function __construct(
        private SubscriptionRepositoryInterface $repository, 
        private MessageRepositoryInterface $message
    ) { 
    }
    
    public function index()
    {
        $data = $this->repository->getAllSubscriptions();
        return $this->sendResponse($data, 'fetched Successfully');
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
        $request->all(),
        ['confirm' => 'required']);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $attributes = [
            'confirm'=> $request->confirm,
            'user_id'=> $request->user_id
        ];
        
        $subscription =  $this->repository->createSubscription($attributes);
        $success['confirm'] =  $subscription->confirm;
        $success['user_id'] =  $subscription->user_id;
        $user = Auth::user();
        $subscription_message = $this->message->subscriptionMessage();
        $user->notify(new UserSubscription($subscription_message));
        
        return $this->sendResponse($success, 'Subscription Successfully Created'); 
    }

    public function show(Subscription $subscription)
    {
       $subscription = $this->repository->getSubscriptionById($subscription);

       return $this->sendResponse($success, 'Subscription Found');
    }

    public function update(Subscription $subscription, Request $request)
    {
        $this->repository->updateSubscription($subscription, $attributes);

        return $this->sendResponse($success, 'Successfully Updated');
    }

    public function destroy(Subscription $subscription)
    {
        $this->repository->deleteSubscription($subscription);

        return $this->sendResponse('Subscription Delete Successfull', 204);
    }
}
