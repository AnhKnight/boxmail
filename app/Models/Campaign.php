<?php

namespace App\Models;

use App\Models\Concerns\BelongsToUser;

class Campaign extends \Spatie\Mailcoach\Models\Campaign
{
    use BelongsToUser;
}
