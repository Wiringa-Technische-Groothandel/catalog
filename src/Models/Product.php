<?php

namespace WTG\Catalog\Models;

use Illuminate\Database\Eloquent\Model;
use WTG\Catalog\Interfaces\CustomerInterface;

class Product extends Model implements CustomerInterface
{
    /**
     * Get the id of the product
     *
     * @return int
     */
    public function getId()
    {
        return $this->attributes['id'];
    }
}