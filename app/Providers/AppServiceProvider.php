<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        $this->app['validator']->extend('emptyArray', function ($attribute, $values, $parameters)
        {
            foreach($values as $data){
                if(count($data)) return true;
            }
            return false;
        });

        Validator::replacer('emptyArray', function ($message, $attribute, $rule, $parameters) {
        return 'You need to fill up at least one field for '.$attribute;
        
    });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
