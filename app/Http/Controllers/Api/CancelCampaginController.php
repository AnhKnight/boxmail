<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use Illuminate\Support\Facades\Bus;
use Spatie\Mailcoach\Enums\CampaignStatus;
use Spatie\Mailcoach\Http\Api\Controllers\Concerns\RespondsToApiRequests;

class CancelCampaginController extends Controller
{
    use RespondsToApiRequests;

    public function __invoke(Campaign $campaign)
    {
        
        $batch = Bus::findBatch(
            $campaign->send_batch_id
        );

        $batch->cancel();

        $campaign->update([
            'status' => CampaignStatus::CANCELLED,
            'sent_at' => now(),
        ]);

        return $this->respondOk();
    }
}
