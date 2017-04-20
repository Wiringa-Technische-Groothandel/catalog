<?php

namespace WTG\Catalog\Interfaces;

/**
 * Discount interface
 *
 * @package     WTG\Catalog
 * @subpackage  Interfaces
 * @author      Thomas Wiringa <thomas.wiringa@gmail.com>
 */
interface DiscountInterface
{
    /**
     * Get a discount by the product model.
     *
     * @param  ProductInterface  $product
     * @return mixed
     */
    public static function findDiscountByProduct(ProductInterface $product): DiscountInterface;

    /**
     * Get the product id
     *
     * @return string
     */
    public function getId(): string;

    /**
     * Set the id
     *
     * @param  string  $id
     * @return $this
     */
    public function setId(string $id);
}