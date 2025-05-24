<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Api\SiteApi;    

class SiteController extends Controller
{
    protected $siteApi;
    public function __construct(SiteApi $siteApi)
    {
        $this->siteApi = $siteApi;
    }
public function index(Request $request)
    {
        try {
            $sites = $this->siteApi->getSites();
            if (!$sites) {
                return response()->json(['error' => 'No sites found'], 404);
            }
            return response($sites, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch site'], 500);
        }
    }
    public function show(Request $request)
    {
        try {
            $site_id = $request->input('site_id');
            if (!$site_id) {
                return response()->json(['error' => 'Site ID is required'], 400);
            }
            $site = $this->siteApi->show($site_id);
            if (!$site) {
                return response()->json(['error' => 'Site not found'], 404);
            }
            return response($site, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch site'], 500);
        }
    }
}
