<?php

namespace Yhy\GdUtil\Providers;

use Illuminate\Support\ServiceProvider;
use Yhy\GdUtil\Gd2;
use Yhy\GdUtil\Str;

class Gd2ServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerGd2();
        $this->registerStr();
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * 注册Gd2类
     */
    protected function registerGd2(){
        $this->app->singleton('Gd2',function ($app){
            return new Gd2();
        });
    }

    /**
     * 注册str类
     */
    protected function registerStr(){
        $this->app->singleton('Str',function ($app){
            return new Str();
        });
    }
}
