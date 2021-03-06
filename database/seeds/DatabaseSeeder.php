<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
                        RoleSeeder::class,
                        PaymentMethodSeeder::class,
                        PaymentStateSeeder::class,
                        ProfileParticipantSeeder::class,
                        PermissionSeeder::class,
                        StateProgrammerMembershipSeeder::class,
                        StateNoteSeeder::class
                    ]);
    }
}
