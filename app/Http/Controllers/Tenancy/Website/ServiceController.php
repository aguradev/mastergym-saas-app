<?php

namespace App\Http\Controllers\Tenancy\Website;

use App\Http\Controllers\Controller;
use App\Models\TenancyModel\WebsiteContent;
use Faker\Core\File;
use App\Rules\ServiceUploadImage;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ServiceController extends Controller
{
    public function showService()
    {
        return WebsiteContent::select("service")->latest()->first();
    }

    public function fetchServiceData()
    {
        $serviceUnparsed = WebsiteContent::select("service")->latest()->first();
        $service = json_decode($serviceUnparsed->service);

        return Inertia::render("dashboard/tenant_page/website_content_page/Service", compact('service'));
    }

    public function updateServiceData(Request $req)
    {

        if ($req->file('cards') != null) {

            dd($req);

            $req->validate([
                'title' => 'required|max:20',
                'text' => 'required|max:500',
                'cards.*.name' => 'required|max:20',
                'cards.*.image' => 'mimes:jpeg,png,jpg|max:2048'
            ]);

            // $rules = [
            //     'title' => 'required|max:20',
            //     'text' => 'required',
            //     'cards.*.name' => 'required|max:20',
            // ];

            // // Dynamically add the custom validation rule for each card image
            // foreach ($req->input('cards', []) as $index => $card) {
            //     $rules["cards.$index.image"] = ['nullable', 'mimes:jpeg,png,jpg', 'max:2048', new ServiceUploadImage];
            // }

            // $req->validate($rules);

            // dd($req);

            $prefix = "tenant-" . tenant('id') . '/assets/website/images';

            $image_name1 = array_key_exists(0, $req->file('cards')) ? $req->file('cards')[0]['image']->store($prefix) : $req->cards[0]['image'];
            $image_name2 = array_key_exists(1, $req->file('cards')) ? $req->file('cards')[1]['image']->store($prefix) : $req->cards[1]['image'];
            $image_name3 = array_key_exists(2, $req->file('cards')) ? $req->file('cards')[2]['image']->store($prefix) : $req->cards[2]['image'];
            $image_name4 = array_key_exists(3, $req->file('cards')) ? $req->file('cards')[3]['image']->store($prefix) : $req->cards[3]['image'];

            $value = [
                'title' => $req->title,
                'text' => $req->text,
                'cards' => [
                    [
                        'id' => 1,
                        'name' => $req->cards[0]['name'],
                        'image' => $image_name1,
                    ],
                    [
                        'id' => 2,
                        'name' => $req->cards[1]['name'],
                        'image' => $image_name2
                    ],
                    [
                        'id' => 3,
                        'name' => $req->cards[2]['name'],
                        'image' => $image_name3
                    ],
                    [
                        'id' => 4,
                        'name' => $req->cards[3]['name'],
                        'image' => $image_name4
                    ]
                ]
            ];
        } else {

            $req->validate([
                'title' => 'required|max:20',
                'text' => 'required|max:500',
                'cards.*.name' => 'required|max:20',
            ]);

            $value = [
                'title' => $req->title,
                'text' => $req->text,
                'cards' => [
                    [
                        'id' => 1,
                        'name' => $req->cards[0]['name'],
                        'image' => $req->cards[0]['image'],
                    ],
                    [
                        'id' => 2,
                        'name' => $req->cards[1]['name'],
                        'image' => $req->cards[1]['image']
                    ],
                    [
                        'id' => 3,
                        'name' => $req->cards[2]['name'],
                        'image' => $req->cards[2]['image']
                    ],
                    [
                        'id' => 4,
                        'name' => $req->cards[3]['name'],
                        'image' => $req->cards[3]['image']
                    ]
                ]
            ];
        }

        $website = WebsiteContent::latest()->first();
        $website->service = json_encode($value);
        $website->save();


        if (!$website) {
            return redirect()->back()->with("message_error", "Update service content failed...");
        }

        return redirect()->back()->with("message_success", "Service content updated!");
    }
}
