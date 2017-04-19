<?php

namespace WTG\Catalog\Models;

use Illuminate\Database\Eloquent\Collection;
use WTG\Catalog\Interfaces\ProductInterface;
use Illuminate\Database\Eloquent\Model;

/**
 * Discount model
 *
 * @package     WTG\Catalog
 * @subpackage  Models
 * @author      Thomas Wiringa <thomas.wiringa@gmail.com>
 */
class Discount extends Model
{
    /**
     * @var bool
     */
    public $incrementing = false;

    public static function findDiscountByProduct(ProductInterface $product)
    {
        $productSku = $product->getSku();
        $productGroup = $product->getGroup();

        /** @var Collection $discounts */
        $discounts = static::where('product', $productSku)
            ->orWhere('product', $productGroup)
            ->orderBy('level', 'desc')
            ->get();

        if ($discounts->isNotEmpty()) {
            return $discounts->first();
        }

        \Log::warning("[Discount] Product '".$product->getId()."' does not have a discount for customer '".\Auth::user()->getCompany()->getCustomerNumber()."'");
    }
}