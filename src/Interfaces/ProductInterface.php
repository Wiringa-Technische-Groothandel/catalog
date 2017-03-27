<?php

namespace WTG\Catalog\Interfaces;

/**
 * Product interface
 *
 * @package     WTG\Catalog
 * @subpackage  Interfaces
 * @author      Thomas Wiringa <thomas.wiringa@gmail.com>
 */
interface ProductInterface
{
    /**
     * Get the product id
     *
     * @return string
     */
    public function getId();
}