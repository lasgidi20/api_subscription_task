<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contract\SubscriptionRepositoryInterface;
use App\Contract\MessageRepositoryInterface;
use App\Contract\PostRepositoryInterface;
use App\Repositories\SubscriptionRepository;
use App\Repositories\PostRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(SubscriptionRepositoryInterface::class, SubscriptionRepository::class);
        $this->app->bind(MessageRepositoryInterface::class, MessageRepository::class);
        $this->app->bind(PostRepositoryInterface::class, PostRepository::class);
    }

    public function boot(): void
    {
    }
}
