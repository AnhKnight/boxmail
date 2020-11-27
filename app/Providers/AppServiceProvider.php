<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Spatie\Mailcoach\Http\Api\Controllers\Campaigns\CampaignsController;
use Spatie\Mailcoach\Http\App\Queries\CampaignsQuery;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('Spatie\Mailcoach\Http\App\Queries\CampaignsQuery', 'App\Queries\CampaignsQuery');
        $this->app->bind('Spatie\Mailcoach\Actions\Campaigns\UpdateCampaignAction', 'App\Http\Actions\UpdateCampaignAction');
        $this->app->bind('Spatie\Mailcoach\Http\Api\Requests\CampaignRequest', 'App\Http\Requests\CampaignRequest');
        // $this->app->when(CampaignsController::class)
        //   ->needs(CampaignsQuery::class)
        //   ->give(\App\Queries\CampaignsQuery::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
