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
        $titlePage = tenant('name');
        $heroUnparsed = WebsiteContent::select("hero")->latest()->first();
        $hero = json_decode($heroUnparsed->hero);

        return Inertia::render("dashboard/tenant_page/website_content_page/Hero", compact('hero', 'titlePage'));
    }

    public function updateHeroData(Request $req)
    {
        if ($req->file("image") != null) {

            $req->validate([
                'title' => 'required|max:50',
                'btnLeft' => 'required|max:20',
                'btnRight' => 'required|max:20',
                'image' => 'mimes:jpeg,png,jpg|max:2048',
            ]);

            $prefix = "tenant-" . tenant('id') . '/assets/website/images';

            $image_name = $req->file('image')->store($prefix);

            $value = [
                'image' => $image_name,
                'title' => $req->title,
                'btnLeft' => $req->btnLeft,
                'btnRight' => $req->btnRight,
            ];
        } else {

            $req->validate([
                'title' => 'required|max:50',
                'btnLeft' => 'required|max:20',
                'btnRight' => 'required|max:20',
            ]);

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