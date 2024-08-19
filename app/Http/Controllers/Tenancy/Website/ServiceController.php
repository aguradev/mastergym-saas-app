<?php

namespace App\Http\Controllers\Tenancy\Website;

use App\Http\Controllers\Controller;
use App\Models\TenancyModel\WebsiteContent;
use Faker\Core\File;
use App\Rules\ServiceUploadImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ServiceController extends Controller
{
    public function showService()
    {
        return WebsiteContent::select("service")->latest()->first();
    }

    public function fetchServiceData()
    {
        $titlePage = tenant('name');
        $userLogin = Auth::guard("tenant-web")->user();
        $serviceUnparsed = WebsiteContent::select("service")->latest()->first();
        $service = json_decode($serviceUnparsed->service);

        return Inertia::render(
            "dashboard/tenant_page/website_content_page/Service",
            compact('service', 'titlePage', 'userLogin')
        );
    }

    public function updateServiceData(Request $req)
    {

        if ($req->file('cardImage') != null) {


            $req->validate([
                'title' => 'required|max:20',
                'text' => 'required|max:500',
                'cards.*.name' => 'required|max:20',
                'cardImage.*' => 'nullable|mimes:jpg,png|max:2048'
            ]);

            $prefix = "public/tenant-" . tenant('id') . '/assets/website/images';

            $image_name1_old = array_key_exists(0, $req->file('cardImage')) ? $req->file('cardImage')[0]->store($prefix) : $req->cards[0]['image'];
            $image_name2_old = array_key_exists(1, $req->file('cardImage')) ? $req->file('cardImage')[1]->store($prefix) : $req->cards[1]['image'];
            $image_name3_old = array_key_exists(2, $req->file('cardImage')) ? $req->file('cardImage')[2]->store($prefix) : $req->cards[2]['image'];
            $image_name4_old = array_key_exists(3, $req->file('cardImage')) ? $req->file('cardImage')[3]->store($prefix) : $req->cards[3]['image'];


            $image_name1 = str_replace("public", "/storage", $image_name1_old);
            $image_name2 = str_replace("public", "/storage", $image_name2_old);
            $image_name3 = str_replace("public", "/storage", $image_name3_old);
            $image_name4 = str_replace("public", "/storage", $image_name4_old);

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