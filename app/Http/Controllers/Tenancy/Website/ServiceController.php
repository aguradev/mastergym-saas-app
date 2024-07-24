<?php

namespace App\Http\Controllers\Tenancy\Website;

use App\Http\Controllers\Controller;
use App\Models\TenancyModel\WebsiteContent;
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
        // dd($req->file('cards'));
        // dd($req->cards[0]['image']);

        if ($req->file('cards') != null) {

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
            return redirect()->back()->with("message_error", "Update footer content failed...");
        }

        return redirect()->back()->with("message_success", "Footer content updated!");
    }
}