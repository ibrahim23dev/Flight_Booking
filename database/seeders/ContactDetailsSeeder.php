<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ContactDetail;
class ContactDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'address' => 'Narshing Chowk, Kathmandu | Nepal.',
                'phone' => '977 1-5362528',
                'email' => 'info@flightconnectionintl.com',
                'social_media' => [
                    'facebook' => 'https://www.facebook.com',
                    'instagram' => 'https://www.instagram.com',
                    'twitter' => 'https://twitter.com',
                    'linkedin' => 'https://linkedin.com',
                ],
            ],
            // Add more contact details if needed...
        ];

        foreach ($data as $contactDetailData) {
            ContactDetail::create($contactDetailData); 
        }
    }
}
