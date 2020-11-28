<?php

namespace App\Http\Controllers\Api;

use Symfony\Component\HttpFoundation\Response;
use Spatie\Mailcoach\Http\Api\Controllers\Concerns\RespondsToApiRequests;

use Spatie\Mailcoach\Models\Subscriber;

class ResubscribeController
{
    use RespondsToApiRequests;

    public function __invoke(Subscriber $subscriber)
    {
        if (! $subscriber->isUnsubscribed()) {
            abort(Response::HTTP_UNPROCESSABLE_ENTITY, 'The subscriber was already confirmed');
        }

        $subscriber->update([
            'unsubscribed_at' => null,
        ]);

        $this->respondOk();
    }
}
