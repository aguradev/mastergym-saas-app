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
        $nav = [
            'title' => 'Tenant Gym - Home',
            'menus' => [
                'HOME',
                'OUR SERVICE',
                'MEMBERSHIP',
                'OUR REVIEWS',
                'ABOUT US'
            ]
        ];

        $hero = [
            'image' => '/public/assets/images/icon/hero.png',
            'title' => "Get In Shape With Our Service!",
            'btnLeft' => "get started!",
            'btnRight' => "learn more ->",
        ];

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

        //php artisan tenants:seed --class=Database\\Seeders\\Tenants\\TenantWebsiteSeeder

        $testimony = [
            'title' => "read trusted reviews from our customers",
            'text' => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur praesentium natus sapiente commodi. Aliquid sunt tempore iste repellendus explicabo dignissimos placeat, autem harum dolore reprehenderit quis! Quo totam dignissimos earum.",
            'button' => "read all reviews ->",
            'cards' => [
                [
                    'stars' => 5,
                    'title' => "stayin' alive",
                    'text' => "As a regular gym-goer, I've found this gym to be the perfect place to stay motivated and fit. The wide range of equipment means I never get bored with my workouts, and the staff are always on hand to offer tips and support. The classes are diverse and cater to all fitness levels, making it easy to find something that suits my mood and goals. ",
                    'name' => "john weak"
                ],
                [
                    'stars' => 3,
                    'title' => "the facility is great!",
                    'text' => "The gym is an incredible place to push your limits and achieve your fitness goals. The state-of-the-art equipment, variety of classes, and knowledgeable trainers create an environment that is both challenging and supportive. From the moment you walk in, you're greeted with a clean, motivating space filled with like-minded individuals.",
                    'name' => "gavid doggins"
                ],
                [
                    'stars' => 4,
                    'title' => "the best experience!",
                    'text' => "I've been a member of this gym for over a year, and it continues to exceed my expectations. The facilities are top-notch, with clean and well-maintained equipment. The trainers are friendly and incredibly knowledgeable, always willing to help with form or suggest new routines. ",
                    'name' => "ben dover"
                ],
            ]
        ];

        $footer = [
            'gymIcon' => '/public/assets/images/icon/gym.png',
            'gymTitle' => "Gym Tenant",
            'briefText' => "Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit.",
            'menus' => [
                "company",
                "about",
                "features",
                "works",
                "contact us",
            ],
            'twitter' => "https://twitter.com",
            'facebook' => "https://facebook.com",
            'instagram' => "https://instagram.com",
        ];

        //SEED CONSOLE COMMAND : php artisan tenants:seed --class=Database\\Seeders\\Tenants\\TenantWebsiteSeeder

        DB::table('website_content')->insert([
            "nav" => json_encode($nav),
            "hero" => json_encode($hero),
            "cta" => json_encode($cta),
            "service" => json_encode($service),
            "membership" => json_encode($pricing),
            "testimony" => json_encode($testimony),
            "footer" => json_encode($footer),
            "created_at" => now(),
            "updated_at" => now(),
        ]);
    }
}
