<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repositories\Personal\PersonalRepositoryInterface;
use App\Repositories\Personal\PersonalRepository;
use App\Repositories\Image\ImageRepositoryInterface;
use App\Repositories\Image\ImageRepository;
use App\Repositories\PDF\PDFRepositoryInterface;
use App\Repositories\PDF\PDFRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $this->app->bind(PersonalRepositoryInterface::class,PersonalRepository::class);
        $this->app->bind(ImageRepositoryInterface::class,ImageRepository::class);
        $this->app->bind(PDFRepositoryInterface::class,PDFRepository::class);


    }
}
