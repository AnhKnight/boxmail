<?php

namespace App\Http\Controllers\Api;

use App\Models\Campaign;
use Spatie\Mailcoach\Http\App\Queries\CampaignSendsQuery;

class CampaignOutboxController
{
    public function __invoke(Campaign $campaign)
    {
        $sendsQuery = new CampaignSendsQuery($campaign);

        return $sendsQuery->paginate();
    }
}
