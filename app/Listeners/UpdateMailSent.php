<?php

namespace App\Listeners;

use Spatie\Mailcoach\Events\CampaignMailSentEvent;

class UpdateMailSent
{
    /**
     * Handle the event.
     *
     * @param  CampaignMailSentEvent  $event
     * @return void
     */
    public function handle(CampaignMailSentEvent $event)
    {
        $tenantId = $event->send->campaign->tenant_id;

        $tenant = \DB::connection('azlink_system')->table('az_systems')->where('id', $tenantId)->first();

        $mailSent = $tenant->mail_sent + 1;
        $mailLeft = $tenant->mail_left - 1;

        \DB::connection('azlink_system')
            ->table('az_systems')
            ->where('id', $tenantId)
            ->update([
                'mail_sent' => $mailSent,
                'mail_left' => $mailLeft,
            ]);

    }
}
