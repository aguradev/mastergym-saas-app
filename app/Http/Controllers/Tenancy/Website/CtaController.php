<?php

namespace App\Http\Controllers\Tenancy\Website;

use App\Http\Controllers\Controller;
use App\Models\TenancyModel\WebsiteContent;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CtaController extends Controller
{
    public function showCallToAction()
    {
        return WebsiteContent::select("cta")->latest()->first();
    }

    public function fetchCtaData()
    {
        $ctaUnparsed = WebsiteContent::select("cta")->latest()->first();
        $cta = json_decode($ctaUnparsed->cta);

        return Inertia::render("dashboard/tenant_page/website_content_page/CallToAction", compact("cta"));
    }

    public function updateCtaData(Request $req)
    {
        if ($req->file('image') != null) {
            $prefix = "tenant-" . tenant('id') . 'assets/website/images';

            $img_name = $req->file('image')->store($prefix);

            $value = [
                'image' => $img_name,
                'header' => $req->header,
                'text' => $req->text,
                'button' => $req->button
            ];
        } else {
            $value = [
                'image' => $req->image,
                'header' => $req->header,
                'text' => $req->text,
                'button' => $req->button
            ];
        }

        $web = WebsiteContent::latest()->first();
        $web->cta = json_encode($value);
        $web->save();

        if (!$web) {
            return redirect()->back()->with("message_error", "Update call to action content failed...");
        }

        return redirect()->back()->with("message_success", "Call to Action Content Updated!");
    }
}
