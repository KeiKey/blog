<?php

namespace App\Http\Controllers;

use App\Events\InquiryCreated;
use App\Http\Requests\ContactUsRequest;
use App\Http\Requests\SubscribeRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SiteController extends Controller
{
    /**
     * Display the required static page.
     *
     * @param $static
     * @return View
     */
    public function index($static): View
    {
        return view('site.static.'.$static);
    }

    /**
     * @param SubscribeRequest $request
     */
    public function subscribe(SubscribeRequest $request)
    {

    }

    /**
     * @param ContactUsRequest $request
     * @return RedirectResponse
     */
    public function contact(ContactUsRequest $request): RedirectResponse
    {
        InquiryCreated::dispatch($request);

        //todo - find how to handle the response for async events
        return redirect()->back()->with('success', 'We will contact you as soon as possible!');
    }
}
