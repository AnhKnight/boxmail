<?php

namespace App\Models;

use App\Models\Concerns\BelongsToUser;

class EmailList extends \Spatie\Mailcoach\Models\EmailList
{
    use BelongsToUser;
}
