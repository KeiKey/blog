<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
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

    public function subscribe()
    {

    }
}
