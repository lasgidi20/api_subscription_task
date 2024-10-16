<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Subscription;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([SubscriptionSeeder::class]);
    }
}
