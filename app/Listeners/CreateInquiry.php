<?php

namespace App\Listeners;

use App\Events\InquiryCreated;
use App\Models\Inquiry\Inquiry;
use Illuminate\Support\Facades\DB;

class CreateInquiry
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(
    ) {
    }

    /**
     * Handle CreateInquiry.
     *
     * @param InquiryCreated $event
     * @return void
     */
    public function handle(InquiryCreated $event)
    {
        $request = $event->getRequest();

        DB::transaction(function () use ($request) {
            Inquiry::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'message' => $request->message
            ]);
        }, 3);
    }
}
