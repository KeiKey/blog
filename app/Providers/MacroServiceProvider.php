<?php

namespace App\Providers;

use App\Enums\ResponseStatus;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\ServiceProvider;

class MacroServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        RedirectResponse::macro( 'success', function(?string $route = null, string $message='Success!') {
            if ($route) {
                return redirect()->route($route)->with(ResponseStatus::SUCCESS, $message);
            }

            return redirect()->back()->with(ResponseStatus::SUCCESS, $message);
        });

        RedirectResponse::macro('error', function(?string $route = null, string $message='Error!') {
            if ($route) {
                return redirect()->route($route)->with(ResponseStatus::FAILURE, $message);
            }

            return redirect()->back()->with(ResponseStatus::FAILURE, $message);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

    }
}
