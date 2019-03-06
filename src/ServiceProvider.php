<?php

namespace Wanghan\Juhe;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    //laravel延迟加载
    protected $defer = true;

    public function register()
    {
        $this->app->singleton(Phone::class, function()
        {
            return new Phone();
        });

        $this->app->alias(Phone::class, 'Phone');
    }

    public function provides()
    {
        return [Phone::class, 'Phone'];
    }
}