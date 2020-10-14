<?php

namespace App\Models;

use App\Models\Concerns\BelongsToUser;

class Template extends \Spatie\Mailcoach\Models\Template
{
    use BelongsToUser;
}
