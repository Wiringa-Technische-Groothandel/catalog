<?php

namespace WTG\Catalog\Providers;

use WTG\Catalog\Models\Product;
use Illuminate\Support\ServiceProvider;
use WTG\Catalog\Interfaces\ProductInterface;

/**
 * Class CatalogServiceProvider
 *
 * @package     WTG\Catalog
 * @subpackage  Providers
 * @author      Thomas Wiringa <thomas.wiringa@gmail.com>
 */
class CatalogServiceProvider extends ServiceProvider
{
    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
//        $this->loadRoutesFrom(__DIR__.'/../routes.php');

        $this->loadMigrationsFrom(__DIR__.'/../Migrations');

        $this->loadTranslationsFrom(__DIR__.'/../Resources/lang', 'catalog');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ProductInterface::class, Product::class);
    }
}
