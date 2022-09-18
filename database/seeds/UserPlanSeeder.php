<?php

use App\UserPlan;
use Illuminate\Support\Arr;
use Illuminate\Database\Seeder;

class UserPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jsonData = file_get_contents(base_path('test-data/user_plans.json'));
        $userPlans = json_decode($jsonData, true)['user_plans'];

        foreach ($userPlans as $userPlan) {
            UserPlan::create(
                Arr::only($userPlan, ['id'])
            );
        }
    }
}
