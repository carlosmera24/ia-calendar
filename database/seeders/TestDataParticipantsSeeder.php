<?php

namespace Database\Seeders;

use App\Models\Person;
use App\Models\Participant;
use App\Models\PersonEmail;
use App\Models\PersonCellphone;
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

        Person::factory(100)
            ->create()
            ->each( function( $person){
                PersonEmail::factory()
                        ->create([
                            'persons_id'    =>  $person->id
                        ]);

                PersonCellphone::factory()
                        ->create([
                            'persons_id'    =>  $person->id
                        ]);

                Participant::factory()
                        ->create([
                            'persons_id'                    =>  $person->id,
                            'programmers_id'                =>  1,
                            'profiles_participants_id'      =>  3,
                        ]);
            });
    }
}
