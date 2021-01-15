<?php

namespace Database\Seeders;

use App\Models\Person;
use App\Models\Participant;
use Illuminate\Database\Seeder;

class TestDataParticipantsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Required previes run TesDataSeeder

        Person::factory(10)
            ->create()
            ->each( function( $person){
                Participant::factory()
                        ->create([
                            'persons_id'                    =>  $person->id,
                            'programmers_id'                =>  1,
                            'profiles_participants_id'      =>  3,
                        ]);
            });
    }
}
