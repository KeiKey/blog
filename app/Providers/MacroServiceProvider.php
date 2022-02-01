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
        RedirectResponse::macro('success', function(string$route, string $message) {
            return redirect()->route($route)->with(ResponseStatus::SUCCESS, $message);
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
