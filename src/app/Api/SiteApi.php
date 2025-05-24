<?php 
declare(strict_types=1);

namespace App\Api;
class SiteApi extends BaseApi
{
    public function getSites(): \Apiz\Http\Response
    {
        return $this->get('/');
    }
    public function showSite(string $site_id): \Apiz\Http\Response
    {
        return $this->get("/{$site_id}");
    }
}
