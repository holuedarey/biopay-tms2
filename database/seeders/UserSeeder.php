<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $name = str(config('app.name'))->replace(' ', '')->lower();
// Default credentials
        $teq = User::factory()->create([
            'first_name' => ucfirst($name),
            'other_names' => 'Admin',
            'email' => config('app.email'),
            'phone' => '08081234567',
            'status' => 'ACTIVE',
        ]);

        $teq->first()->assignRole(Role::SUPERADMIN);

//         $this->fakeRecords();
    }

    public function fakeRecords(): void
    {
        // Fake admin
        $admin = User::factory(9)->create();

        $admin_roles = Role::query()->where('type', User::GROUPS[0])->pluck('name')->toArray();

//        assign role to admin
        $admin->each(fn(User $user) => $user->assignRole($admin_roles[rand(0,1)]));

        $super_agents = User::factory(3)->create(['level_id' => 1]);
        $super_agents->each(fn(User $user) => $user->assignRole(Role::SUPERAGENT));

        $agents1 = User::factory(5)->create([
            'level_id' => 1,
        ]);

        $agents = User::factory(5)->create([
            'level_id' => 1,
            'super_agent_id' => $super_agents->pluck('id')->toArray()[rand(0, $super_agents->count())]
        ]);

        $agents->merge($agents1)->each( fn(User $user) => $user->assignRole(Role::AGENT));
    }
}
