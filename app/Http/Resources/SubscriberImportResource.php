<?php

namespace App\Http\Resources;

use Spatie\Mailcoach\Http\Api\Resources\SubscriberImportResource as ResourcesSubscriberImportResource;
use Spatie\Mailcoach\Http\Api\Resources\EmailListResource;

class SubscriberImportResource extends ResourcesSubscriberImportResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => (int)$this->id,
            'uuid' => $this->uuid,
            'subscribers_csv' => $this->subscribers_csv,
            'status' => $this->status,
            'email_list' => new EmailListResource($this->whenLoaded('emailList')),
            'subscribe_unsubscribed' => (bool)$this->subscribe_unsubscribed,
            'unsubscribe_others' => (bool)$this->unsubscribe_others,
            'imported_subscribers_count' => (int)$this->imported_subscribers_count,
            'error_count' => (int)$this->error_count,
            'created_at' => $this->created_at
        ];
    }
}
