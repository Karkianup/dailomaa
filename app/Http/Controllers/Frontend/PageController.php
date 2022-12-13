<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Page;
use App\SiteSetting;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function show($slug)
    {
        $convertSlug = str_replace('-', ' ', $slug);

        $page = Page::where('title', $convertSlug)->first() ?? abort(404);

        $siteSEO = SiteSetting::select('title', 'meta_title', 'site_url', 'meta_description', 'twitter', 'default_image')->get()->toArray();

        // dd($siteSEO);

        SEOMeta::setTitle($page['title'] . ' &#8211; ' . $siteSEO[0]['title']);
        SEOMeta::setDescription($siteSEO[0]['meta_description']);


        OpenGraph::setTitle($convertSlug);
        OpenGraph::setUrl($siteSEO[0]['site_url'] . '/' . 'page/' . $slug . '/');
        OpenGraph::setDescription($siteSEO[0]['meta_description']);
        OpenGraph::addImage($siteSEO[0]['site_url'] . '/' . 'Asset/Uploads/Default/' . $siteSEO[0]['default_image']);
        OpenGraph::setSiteName($siteSEO[0]['title']);
        OpenGraph::addProperty('type', 'article');

        TwitterCard::setType('article');
        TwitterCard::setSite($siteSEO[0]['twitter']);
        TwitterCard::setTitle($siteSEO[0]['title']);
        TwitterCard::setDescription($siteSEO[0]['meta_description']);
        TwitterCard::addImage($siteSEO[0]['site_url'] . '/' . 'Asset/Uploads/Logo/logo.png');


        return view('Frontend.Page.index', compact('page'));
    }
}
