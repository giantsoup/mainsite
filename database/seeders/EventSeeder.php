<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = [
            [
                'name' => '2020'
                , 'is_active' => false
                , 'has_pairings' => false
            ],
            [
                'name' => '2021'
                , 'is_active' => false
                , 'has_pairings' => false
            ],
            [
                'name' => '2022'
                , 'is_active' => false
                , 'has_pairings' => false
            ],
            [
                'name' => '2023'
                , 'is_active' => true
                , 'has_pairings' => false
            ],
        ];

        foreach ($events as $event) {
            Event::create($event);
        }
    }
}
