<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TermsPrivacy;

class TermsPrivacySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $data = [
            [
                'title' => 'Terms and Conditions',
                'points' => [
                    ['heading' => 'Your Agreement', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'],
                    ['heading' => 'Change of Terms of Use', 'description' => 'Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'],
                    ['heading' => 'Access and Use of the Services', 'description' => 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.'],
                ],
            ],
            [
                'title' => 'Cookie Policy',
                'points' => [
                    ['heading' => 'What are Cookies', 'description' => 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.'],
                    ['heading' => 'How We Use Cookies', 'description' => 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'],
                ],
            ],
            [
                'title' => 'Privacy Policy',
                'points' => [
                    ['heading' => 'Information We Collect', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'],
                    ['heading' => 'How We Use Your Information', 'description' => 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.'],
                ],
            ],
        ];

        // Insert data into the database
        foreach ($data as $item) {
            TermsPrivacy::create([
                'title' => $item['title'],
                'points' => json_encode($item['points']),
            ]);
        }
    }
}
