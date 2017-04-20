<?php

namespace WTG\Catalog\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use WTG\Catalog\Interfaces\ProductInterface;
use WTG\Catalog\Interfaces\DiscountInterface;

/**
 * Discount model
 *
 * @package     WTG\Catalog
 * @subpackage  Models
 * @author      Thomas Wiringa <thomas.wiringa@gmail.com>
 */
class Discount extends Model implements DiscountInterface
{
    /**
     * @var bool
     */
    public $incrementing = false;

    /**
     * Get a discount by the product model.
     *
     * @param  ProductInterface  $product
     * @return mixed
     */
    public static function findDiscountByProduct(ProductInterface $product): DiscountInterface
    {
        $productSku = $product->getSku();
        $productGroup = $product->getGroup();

        /** @var Collection $discounts */
        $discounts = app()->make(DiscountInterface::class)
            ->where('product', $productSku)
            ->orWhere('product', $productGroup)
            ->orderBy('level', 'desc')
            ->get();

        if ($discounts->isNotEmpty()) {
            return $discounts->first();
        }

        \Log::warning("[Discount] Product '".$product->getId()."' does not have a discount for customer '".\Auth::user()->getCompany()->getCustomerNumber()."'");
    }

    /**
     * Get the discount id.
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->attributes['id'];
    }

    /**
     * Set the discount id
     *
     * @param  string  $id
     * @return $this
     */
    public function setId(string $id)
    {
        $this->attributes['id'] = $id;

        return $this;
    }
}