<?php

namespace WTG\Catalog\Seeders;

use Illuminate\Database\Seeder;
use WTG\Catalog\Models\Discount;

/**
 * Discounts table seeder
 *
 * @package     WTG\Catalog
 * @subpackage  Seeders
 * @author      Thomas Wiringa <thomas.wiringa@gmail.com>
 */
class DiscountsTableSeeder extends Seeder
{
    /**
     * Run the seeder
     *
     * @return void
     */
    public function run()
    {
        factory(Discount::class)->times(100)->create();
    }
}