<?php

namespace App\Http\Controllers\Tenancy\Website;

use App\Http\Controllers\Controller;
use App\Models\TenancyModel\WebsiteContent;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HeroController extends Controller
{
    public function showHero()
    {
        return WebsiteContent::select("hero")->latest()->first();
    }

    public function fetchHeroData()
    {
        $hero = WebsiteContent::select("hero")->latest()->first();

        return Inertia::render("dashboard/tenant_page/website_content_page/Hero", $hero);
    }

    public function updateHeroData(Request $req)
    {
        if ($req->file("image") != null) {

            $req->file('image')->store('assets/website/images');
            $image_name = "tenant" . tenant('id');

            dd($image_name);

            $value = [
                'image' => $req->$image_name,
                'title' => $req->title,
                'btnLeft' => $req->btnLeft,
                'btnRight' => $req->btnRight,
            ];
        } else {
            $value = [
                'image' => $req->image,
                'title' => $req->title,
                'btnLeft' => $req->btnLeft,
                'btnRight' => $req->btnRight,
            ];
        }

        // tenant id
        $url = asset("website/images/Noym6hkUtCuLkV7ldY3hThjKvDHaYk3Qo9yDa  AdL.jpg");
        // storage\tenant-9c855257-f207-4264-a261-395318631d7f\app\public\assets\website\images\Noym6hkUtCuLkV7ldY3hThjKvDHaYk3Qo9yDaAdL.jpg
        // dd($value);
        dd($url);

        $website = WebsiteContent::first();
        $website->hero = json_encode($value);
        $website->save();
    }
}