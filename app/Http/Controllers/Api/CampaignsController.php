<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\CampaignResource;
use App\Models\Campaign;

class CampaignsController
{
    public function show(Campaign $campaign)
    {
        return new CampaignResource($campaign);
    }
}
