<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class LanguageServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $lang_list = \DB::table('languages')->get();

        $lang_config = [];

        foreach($lang_list as $lang){

            $lang_config[$lang->code] = ['name' => $lang->name, 'script' => $lang->script, 'native' => $lang->native, 'regional' => $lang->regional];
        }

        config(['laravellocalization.supportedLocales' => $lang_config ]);
    }
}
