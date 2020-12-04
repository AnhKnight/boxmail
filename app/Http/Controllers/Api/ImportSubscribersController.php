<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Mailcoach\Http\App\Queries\EmailListQuery;
use Spatie\Mailcoach\Models\EmailList;
use Spatie\Mailcoach\Models\SubscriberImport;
use App\Http\Resources\SubscriberImportResource;

class ImportSubscribersController extends Controller
{
    public function show(EmailList $emailList)
    {
        $subscribersImport = SubscriberImport::query()
                        ->with('emailList')
                        ->where('email_list_id', $emailList->id)
                        ->paginate();

        return SubscriberImportResource::collection($subscribersImport);
    }
}
