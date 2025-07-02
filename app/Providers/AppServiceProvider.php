<?php

namespace App\Providers;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Validator::replacer('regex', function ($message, $attribute, $rule, $parameters) {
            if ($attribute === 'name') {
                return 'El campo nombre solo debe contener letras y espacios.';
            }
            return $message;
        });
    }
}
