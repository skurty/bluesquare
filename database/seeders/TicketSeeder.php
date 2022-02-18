<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\User;
use App\Models\Ticket;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $project = Project::factory()->create();
        $user    = User::factory()->create();

        Ticket::factory()
            ->count(2)
            ->for($project)
            ->for($user)
            ->hasComments(1)
            ->create();
    }
}
