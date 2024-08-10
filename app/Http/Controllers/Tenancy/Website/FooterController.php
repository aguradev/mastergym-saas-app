<?php

namespace App\Http\Controllers\Tenancy\Website;

use App\Http\Controllers\Controller;
use App\Models\TenancyModel\WebsiteContent;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FooterController extends Controller
{
    public function showFooter()
    {
        return WebsiteContent::select("footer")->latest()->first();
    }

    public function fetchFooterData()
    {
        $titlePage = tenant('name');
        $unparsedFooter = WebsiteContent::select("footer")->latest()->first();
        $footer = json_decode($unparsedFooter->footer);

        return Inertia::render("dashboard/tenant_page/website_content_page/Footer", compact('footer', 'titlePage'));
    }

    public function updateFooterData(Request $req)
    {
        // dd($req);

        $req->validate([
            'gymIcon' => 'mimes:jpg,png|max:2048',
            'gymTitle' => 'required|max:20',
            'briefText' => 'required|max:255',
            'menus1' => 'required|max:12',
            'menus2' => 'required|max:12',
            'menus3' => 'required|max:12',
            'menus4' => 'required|max:12',
            'menus5' => 'required|max:12',
            'twitter' => 'required|max:100',
            'facebook' => 'required|max:100',
            'instagram' => 'required|max:100',
        ]);

        dd('tetot');

        $menu_items = [
            $req->menus1,
            $req->menus2,
            $req->menus3,
            $req->menus4,
            $req->menus5,
        ];

        if ($req->file('gymIcon') != null) {

            $prefix = "tenant-" . tenant('id') . '/assets/website/images';

            $image_name = $req->file('gymIcon')->store($prefix);

            $value = [
                'gymIcon' => $image_name,
                'gymTitle' => $req->gymTitle,
                'briefText' => $req->briefText,
                'menus' => $menu_items,
                'twitter' => $req->twitter,
                'facebook' => $req->facebook,
                'instagram' => $req->instagram,
            ];
        } else {

            $value = [
                'gymIcon' => $req->gymIcon,
                'gymTitle' => $req->gymTitle,
                'briefText' => $req->briefText,
                'menus' => $menu_items,
                'twitter' => $req->twitter,
                'facebook' => $req->facebook,
                'instagram' => $req->instagram,
            ];
        }

        $website = WebsiteContent::latest()->first();
        $website->footer = json_encode($value);
        $website->save();

        if (!$website) {
            return redirect()->back()->with("message_error", "Update footer content failed...");
        }

        return redirect()->back()->with("message_success", "Footer content updated!");
    }
}