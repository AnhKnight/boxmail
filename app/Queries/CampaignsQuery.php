<?php

namespace App\Queries;

use Spatie\Mailcoach\Http\App\Queries\CampaignsQuery as QueriesCampaignsQuery;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\Mailcoach\Http\App\Queries\Filters\CampaignStatusFilter;
use Spatie\Mailcoach\Http\App\Queries\Filters\FuzzyFilter;
use Spatie\Mailcoach\Http\App\Queries\Sorts\CampaignSort;
use Spatie\Mailcoach\Traits\UsesMailcoachModels;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;

class CampaignsQuery extends QueriesCampaignsQuery
{
    public function __construct()
    {
        QueryBuilder::__construct($this->getCampaignClass()::query()->with('emailList'));

        $sentSort = AllowedSort::custom('sent', (new CampaignSort()))->defaultDirection('desc');

        $this
            ->defaultSort($sentSort)
            ->allowedSorts(
                'name',
                'email_list_id',
                'unique_open_count',
                'unique_click_count',
                'unsubscribe_rate',
                'sent_to_number_of_subscribers',
                $sentSort,
            )
            ->allowedFilters(
                AllowedFilter::custom('search', new FuzzyFilter('name')),
                AllowedFilter::custom('status', new CampaignStatusFilter())
            );
    }
}
