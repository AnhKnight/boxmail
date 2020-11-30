<?php

namespace App\Http\Controllers\Api;

use Spatie\Mailcoach\Models\Campaign;
use Spatie\Mailcoach\Models\EmailList;

class CheckEmailListUsedController
{
    public function __invoke(EmailList $emailList)
    {
        if (Campaign::where('email_list_id', $emailList->id)->exists()) {
            return true;
        }
        return false;
    }
}
