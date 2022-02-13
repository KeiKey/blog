<?php

namespace App\Providers;

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
                return redirect()->route($route)->with('success', $message);
            }

            return redirect()->back()->with('success', $message);
        });

        RedirectResponse::macro('error', function(?string $route = null, string $message='Error!') {
            if ($route) {
                return redirect()->route($route)->with('error', $message);
            }

            return redirect()->back()->with('error', $message);
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
