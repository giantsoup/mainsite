<?php

namespace Database\Seeders;

use App\Models\Exclusion;
use App\Models\Participant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class ParticipantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $participants = [
            [
                'id' => 1
                , 'first_name' => 'Taylor'
                , 'last_name' => 'Oyer'
                , 'email' => 'testing@mailinator.com'
                , 'phone' => '7608675309'
                , 'exclude' => 2
            ],
            [
                'id' => 2
                , 'first_name' => 'Emilia'
                , 'last_name' => 'Gancarz-Oyer'
                , 'email' => 'testing@mailinator.com'
                , 'phone' => '7608675309'
                , 'exclude' => 1
            ],
            [
                'id' => 3
                , 'first_name' => 'Dawn'
                , 'last_name' => 'Christiansen'
                , 'email' => 'testing@mailinator.com'
                , 'phone' => '7608675309'
                , 'exclude' => 4
            ],
            [
                'id' => 4
                , 'first_name' => 'Bob'
                , 'last_name' => 'Christiansen'
                , 'email' => 'testing@mailinator.com'
                , 'phone' => '7608675309'
                , 'exclude' => 3
            ],
            [
                'id' => 5
                , 'first_name' => 'Megan'
                , 'last_name' => 'Oyer'
                , 'email' => 'testing@mailinator.com'
                , 'phone' => '7608675309'
                , 'exclude' => 6
            ],
            [
                'id' => 6
                , 'first_name' => 'Doug'
                , 'last_name' => 'Garcia'
                , 'email' => 'testing@mailinator.com'
                , 'phone' => '7608675309'
                , 'exclude' => 5
            ],
            [
                'id' => 7
                , 'first_name' => 'Kim'
                , 'last_name' => 'Fulk'
                , 'email' => 'testing@mailinator.com'
                , 'phone' => '7608675309'
                , 'exclude' => 8
            ],
            [
                'id' => 8
                , 'first_name' => 'Brian'
                , 'last_name' => 'Hjilmstead'
                , 'email' => 'testing@mailinator.com'
                , 'phone' => '7608675309'
                , 'exclude' => 7
            ],
            [
                'id' => 9
                , 'first_name' => 'Gerry'
                , 'last_name' => 'Erickson'
                , 'email' => 'testing@mailinator.com'
                , 'phone' => '7608675309'
                , 'exclude' => 10
            ],
            [
                'id' => 10
                , 'first_name' => 'Al'
                , 'last_name' => 'Erickson'
                , 'email' => 'testing@mailinator.com'
                , 'phone' => '7608675309'
                , 'exclude' => 9
            ],
            [
                'id' => 11
                , 'first_name' => 'Nate'
                , 'last_name' => 'Fulk'
                , 'email' => 'testing@mailinator.com'
                , 'phone' => '7608675309'
            ],
        ];

        foreach ($participants as $participant) {
            $participant = Participant::create(Arr::except($participant, ['exclude']));
            $participant->events()->sync([1]);
            if (isset($participant->exclude)) {
                Exclusion::create([
                    'participant_id' => $participant->id
                    , 'excluded_participant_id' => $participant->exclude
                ]);
            }
        }
    }
}
