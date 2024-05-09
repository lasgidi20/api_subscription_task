<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contract\SubscriptionRepositoryInterface;
use App\Contract\MessageRepositoryInterface;
use App\Contract\PostRepositoryInterface;
use App\Repositories\SubscriptionRepository;
use App\Repositories\PostRepository;
use App\Repositories\TeacherRepository;
use App\Repositories\ParentRepository;
use App\Repositories\StudentRepository;


class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(SubscriptionRepositoryInterface::class, SubscriptionRepository::class);
        $this->app->bind(
            MessageRepositoryInterface::class, 
            ParentRepository::class, 
            TeacherRepository::class, 
            StudentRepository::class
        );
        $this->app->bind(PostRepositoryInterface::class, PostRepository::class);
    }

    public function boot(): void
    {
    }
}
