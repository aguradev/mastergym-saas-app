<?php

namespace App\Http\Controllers\Tenancy\Website;

use App\Http\Controllers\Controller;
use App\Models\TenancyModel\WebsiteContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
        $parsed = json_decode($hero->hero);

        return Inertia::render("dashboard/tenant_page/website_content_page/Hero", compact('parsed'));
    }

    public function updateHeroData(Request $req)
    {
        if ($req->file("image") != null) {

            $prefix = "tenant-" . tenant('id') . '/assets/website/images';

            $image_name = $req->file('image')->store($prefix);

            // $url = Storage::disk('public')->url($image_name);
            // $url = asset($image_name);  
            // dd($url);

            // dd($full_url);

            // dd($image_name);

            $value = [
                'image' => $image_name,
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

        $website = WebsiteContent::latest()->first();
        $website->hero = json_encode($value);
        $website->save();

        if (!$website) {
            return redirect()->back()->with("message_error", "Update hero content failed...");
        }

        return redirect()->back()->with("message_success", "Hero content updated!");
    }
}
