<?php

namespace WTG\Catalog\Seeders;

use Illuminate\Database\Seeder;
use WTG\Catalog\Models\Product;

/**
 * Products table seeder
 *
 * @package     WTG\Catalog
 * @subpackage  Seeders
 * @author      Thomas Wiringa <thomas.wiringa@gmail.com>
 */
class ProductsTableSeeder extends Seeder
{
    /**
     * Run the seeder
     *
     * @return void
     */
    public function run()
    {
        factory(Product::class)->times(100)->create();
    }
}