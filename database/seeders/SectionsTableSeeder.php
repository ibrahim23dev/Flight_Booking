<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SectionsContent;
use Illuminate\Support\Facades\Storage;
class SectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $data = [
            [
                'section_type' => 'safe_travel_with_us',
                'section_heading' => 'Safe Travel with us',
                'short_title' => 'These popular destinations have a lot to offer',
                'section_content' => [
                    [
                        'image' => 'image.jpeg',
                        'title' => 'Kathmandu_to_Lukla',
                        'description' => '',
                        'price' => '$190',
                        'from' => 'KTM',
                        'to' => 'LUA',
                    ],
                    [
                        'image' => 'image1.jpeg',
                        'title' => 'Kathmandu_to_Pokhara',
                        'description' => '',
                        'price' => '$190',
                        'from' => 'KTM',
                        'to' => 'PKR',
                    ],
                    [
                        'image' => 'image2.jpeg',
                        'title' => 'Kathmandu_to_Tulmingtar',
                        'description' => '',
                        'price' => '$190',
                        'from' => 'KTM',
                        'to' => 'TMI',
                    ],
                    [
                        'image' => '3.png',
                        'title' => 'Kathmandu_to_Biratnagar',
                        'description' => '',
                        'price' => '$190',
                        'from' => 'KTM',
                        'to' => 'BIR',
                    ],
                ],
            ],
            // You can add more sections if needed...
        ];

        // Insert the data into the database
        foreach ($data as $sectionData) {
            // Convert the section_content to JSON before saving
            $sectionData['section_content'] = json_encode($sectionData['section_content']);
            SectionsContent::create($sectionData);
        }
    }
}
