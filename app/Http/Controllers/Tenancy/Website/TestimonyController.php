<?php

namespace App\Http\Controllers\Tenancy\Website;

use App\Http\Controllers\Controller;
use App\Models\TenancyModel\WebsiteContent;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TestimonyController extends Controller
{
    public function showTestimony()
    {
        return WebsiteContent::select("testimony")->latest()->first();
    }

    public function fetchTestimonyData()
    {
        $unparsedTestimony = WebsiteContent::select("testimony")->latest()->first();
        $testi = json_decode($unparsedTestimony->testimony);

        return Inertia::render('dashboard/tenant_page/website_content_page/Testimony', compact('testi'));
    }

    public function updateTestimonyData(Request $req)
    {

        $req->validate([
            'title' => 'required|max:50',
            'text' => 'required|max:255',
            'cards.*.title' => 'required|max:30',
            'cards.*.text' => 'required|max:500',
            'cards.*.name' => 'required|max:20',
            'cards.*.stars' => 'required|integer|between:1,5',
        ]);


        $value = [
            'title' => $req->title,
            'text' => $req->text,
            'button' => $req->button,
            'cards' => $req->cards,
        ];

        $index = 0;
        foreach ($value['cards'] as $card) {
            $value['cards'][$index]['stars'] = (int)$card['stars'];
            $index += 1;
        }


        $website = WebsiteContent::latest()->first();
        $website->testimony = json_encode($value);
        $website->save();

        if (!$website) {
            return redirect()->back()->with("message_error", "Update testimony content failed...");
        }

        return redirect()->back()->with("message_success", "Footer testimony updated!");
    }
}
