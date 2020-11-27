<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Spatie\Mailcoach\Models\TagSegment;
use Spatie\Mailcoach\Http\Api\Requests\CampaignRequest as SpatieRequest;

class CampaignRequest extends SpatieRequest
{
    public function rules()
    {
        return [
            'name' => ['required'],
            'subject' => '',
            'email_list_id' => ['required', Rule::exists($this->getEmailListTableName(), 'id')],
            'segment_id' => [Rule::exists((new TagSegment())->getTable())],
            'html' => '',
            'structured_html' => '',
            'mailable_class' => '',
            'track_opens' => 'boolean',
            'track_clicks' => 'boolean',
            'schedule_at' => 'date_format:Y-m-d H:i:s',
        ];
    }
}
