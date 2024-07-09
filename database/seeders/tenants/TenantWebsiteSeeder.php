<?php

namespace Database\Seeders\tenants;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TenantWebsiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    //php artisan tenants:seed --class=Database\\Seeders\\Tenants\\TenantWebsiteSeeder

    public function run(): void
    {
        $cta = [
            'image' => 'https://shorturl.at/fYk7V',
            'header' => "Become A member Now!",
            'text' => "Unlock your full potential with our exclusive fitness programs at [Gym Name].Join today and take the first step towards a healthier, stronger you! Our expert trainers, state- of - the - art facilities, and personalized workout plans are designed to help you achieve your fitness goals. Don't wait—transform your life and become part of our vibrant community now! Sign up and start your journey with us.",
            'button' => "JOIN US!",
        ];

        $service = [
            'title' => 'what we provide',
            'text' => 'Lists of services we provide that aims to enhance your fitness journey to the best of our abilities, we make sure to improve your experience using our service as much as possible!',
            'cards' => [
                [
                    'id' => 1,
                    'name' => 'personal trainer',
                    'image' => '/public/assets/images/icon/coach.png'
                ],
                [
                    'id' => 2,
                    'name' => 'gym equipment',
                    'image' => '/public/assets/images/icon/barbell.png'
                ],
                [
                    'id' => 3,
                    'name' => 'membership',
                    'image' => '/public/assets/images/icon/member-card.png'
                ],
                [
                    'id' => 4,
                    'name' => 'gym classes',
                    'image' => '/public/assets/images/icon/timetable.png'
                ]
            ]
        ];

        $pricing = [
            'title' => 'Choose Your Member Type!',
            'text' => 'Here is a list of our membership prices depending on what you need, either monthly or yearly',
            'cards' => [
                [
                    'id' => 1,
                    'title' => 'Basic',
                    'price' => 250000,
                    'features' => [
                        ['id' => 1, 'name' => 'Full Access to gym Equipment'],
                        ['id' => 2, 'name' => 'Weekly Class'],
                        ['id' => 3, 'name' => 'Member Bonus'],
                        ['id' => 4, 'name' => 'Basic Classes'],
                        ['id' => 5, 'name' => '12h per day'],
                        ['id' => 6, 'name' => 'Occasional Events']
                    ],
                    'period' => 'month'
                ],
                [
                    'id' => 2,
                    'title' => 'Ultimate',
                    'price' => 550000,
                    'features' => [
                        ['id' => 1, 'name' => 'Full Access to all Equipment'],
                        ['id' => 2, 'name' => 'Weekly Class'],
                        ['id' => 3, 'name' => 'Ultimate Member Bonus'],
                        ['id' => 4, 'name' => 'Advanced Classes'],
                        ['id' => 5, 'name' => '24h per day'],
                        ['id' => 6, 'name' => 'All Events']
                    ],
                    'period' => 'month'
                ],
                [
                    'id' => 3,
                    'title' => 'Premium',
                    'price' => 350000,
                    'features' => [
                        ['id' => 1, 'name' => 'Full Access to all Equipment'],
                        ['id' => 2, 'name' => 'Weekly Class'],
                        ['id' => 3, 'name' => 'Premium Member Bonus'],
                        ['id' => 4, 'name' => 'More Classes'],
                        ['id' => 5, 'name' => '18h per day'],
                        ['id' => 6, 'name' => 'Most Events']
                    ],
                    'period' => 'month'
                ],
                [
                    'id' => 4,
                    'title' => 'Basic',
                    'price' => 2500000,
                    'features' => [
                        ['id' => 1, 'name' => 'Full Access to gym Equipment'],
                        ['id' => 2, 'name' => 'Weekly Class'],
                        ['id' => 3, 'name' => 'Member Bonus'],
                        ['id' => 4, 'name' => 'Basic Classes'],
                        ['id' => 5, 'name' => '12h per day'],
                        ['id' => 6, 'name' => 'Occasional Events']
                    ],
                    'period' => 'year'
                ],
                [
                    'id' => 5,
                    'title' => 'Ultimate',
                    'price' => 5500000,
                    'features' => [
                        ['id' => 1, 'name' => 'Full Access to all Equipment'],
                        ['id' => 2, 'name' => 'Weekly Class'],
                        ['id' => 3, 'name' => 'Ultimate Member Bonus'],
                        ['id' => 4, 'name' => 'Advanced Classes'],
                        ['id' => 5, 'name' => '24h per day'],
                        ['id' => 6, 'name' => 'All Events']
                    ],
                    'period' => 'year'
                ],
                [
                    'id' => 6,
                    'title' => 'Premium',
                    'price' => 3500000,
                    'features' => [
                        ['id' => 1, 'name' => 'Full Access to all Equipment'],
                        ['id' => 2, 'name' => 'Weekly Class'],
                        ['id' => 3, 'name' => 'Premium Member Bonus'],
                        ['id' => 4, 'name' => 'More Classes'],
                        ['id' => 5, 'name' => '18h per day'],
                        ['id' => 6, 'name' => 'Most Events']
                    ],
                    'period' => 'year'
                ]
            ]
        ];

        DB::table('website_content')->insert([
            // "nav" => json_encode($nav),
            // "hero" => json_encode($hero),
            "cta" => json_encode($cta),
            "service" => json_encode($service),
            "membership" => json_encode($pricing),
            // "testimony" => json_encode($service),
            // "footer" => json_encode($service),
            "created_at" => now(),
            "updated_at" => now(),
        ]);
    }
}
