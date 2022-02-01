<?php

namespace App\Http\Controllers;

use App\Events\InquiryCreated;
use App\Http\Requests\ContactUsRequest;
use App\Http\Requests\SubscribeRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SiteController extends Controller
{

    public function __construct(
    ) {
    }

    /**
     * Display the required static page.
     *
     * @return Application|Factory|View
     */
    public function index($static)
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
