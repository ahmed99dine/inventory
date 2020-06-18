<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Product;
use App\Supplier;
use Hashids\Hashids;
use Illuminate\Support\Facades\Route;


class HashIdModelProvider extends ServiceProvider
{
  /**
  * Register services.
  *
  * @return void
  */
  public function register()
  {
    //
  }

  /**
  * Bootstrap services.
  *
  * @return void
  */
  public function boot()
  {
    Product::created(function($model) {
      $generator = new Hashids(Product::class, 10);
      $model->url_string = $generator->encode($model->id);
      $model->save();
    });

    Supplier::created(function($model) {
      $generator = new Hashids(Supplier::class, 10);
      $model->url_string = $generator->encode($model->id);
      $model->save();
    });


  }
}
