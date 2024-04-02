<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SurroundingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run() :void
    {
        $defaultSurroundings = [
            [
                'heading' => 'Bathroom',
                'points' => [
                    ['point' => 'point name', 'available' => true],
                ],
            ],
            [
                'heading' => 'Media & Technology',
                'points' => [
                    ['point' => 'point name', 'available' => true],
                ],

            ],
            [
                'heading' => 'General',
                'points' => [
                    ['point' => 'point name', 'available' => true],
                ],
                
            ],
            [
                'heading' => 'Room Amenities',
                'points' => [
                    ['point' => 'point name', 'available' => true],
                ],
                
            ],
            [
                'heading' => 'Parking',
                'points' => [
                    ['point' => 'point name', 'available' => true],
                ],
                
            ],
            // Add more default headings and points
        ];

        foreach ($defaultSurroundings as $surrounding) {
            DB::table('amenities')->insert([
                'heading' => $surrounding['heading'],
                'points' => json_encode($surrounding['points']),
            ]);
        }
    }
}
