<?php

namespace App\Http\Controllers\Api;

use App\Models\Campaign;
use Spatie\Mailcoach\Http\Api\Resources\CampaignResource;

class CampaignsController
{
    public function show(Campaign $campaign)
    {
        return new CampaignResource($campaign);
    }
}
