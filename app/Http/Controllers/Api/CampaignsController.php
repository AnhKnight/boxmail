<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\CampaignResource;
use App\Models\Campaign;
use Spatie\Mailcoach\Http\Api\Controllers\Campaigns\CampaignsController as CampaignsCampaignsController;
use Spatie\Mailcoach\Http\App\Queries\CampaignsQuery;
use Spatie\Mailcoach\Models\Send;

class CampaignsController extends CampaignsCampaignsController
{
    public function index(CampaignsQuery $campaigns)
    {
        $campaigns = $campaigns->paginate();

        $countSents = Send::whereNotNull('sent_at')
                    ->select('campaign_id', \DB::raw('count(*) as send_count'))
                    ->whereIn('campaign_id', $campaigns->getCollection()->pluck('id')->toArray())
                    ->groupBy('campaign_id')
                    ->get()
                    ->keyBy('campaign_id');

        $failedCounts = Send::whereNotNull('failed_at')
            ->select('campaign_id', \DB::raw('count(*) as send_count'))
            ->whereIn('campaign_id', $campaigns->getCollection()->pluck('id')->toArray())
            ->groupBy('campaign_id')
            ->get()
            ->keyBy('campaign_id');

        $campaigns->getCollection()->transform(function($campaign) use ($countSents, $failedCounts){
            if (isset($countSents[$campaign->id])) {
                $campaign->send_count = $countSents[$campaign->id];
            } else {
                $campaign->send_count = 0;
            }

            if (isset($failedCounts[$campaign->id])) {
                $campaign->failed_count = $failedCounts[$campaign->id];
            } else {
                $campaign->failed_count = 0;
            }
            return $campaign;
        });
        
        return CampaignResource::collection($campaigns->paginate());
    }

    public function show(Campaign $campaign)
    {
        $campaign->loadCount([
            'sends as send_count' => fn($q) => $q->whereNotNull('sent_at'),
            'sends as failed_count' => fn($q) => $q->whereNotNull('failed_at'),
        ]);
        return new CampaignResource($campaign);
    }
}
