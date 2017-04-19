<?php

namespace WTG\Catalog\Models;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use WTG\Catalog\Interfaces\ProductInterface;

/**
 * Product model
 *
 * @package     WTG\Catalog
 * @subpackage  Models
 * @author      Thomas Wiringa <thomas.wiringa@gmail.com>
 */
class Product extends Model implements ProductInterface
{
    const ACTION_TYPE_SPECIAL = 'action';
    const ACTION_TYPE_CLEARANCE = 'clearance';

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @var string
     */
    protected $image_path = 'img/products';

    /**
     * @return Collection
     */
    public static function getBrandCollection(): Collection
    {
        return static::distinct()->get(['brand'])->flatten()->map(function ($item) {
            return $item->getBrand();
        })->sort();
    }

    /**
     * @param  string  $brand
     * @return Collection
     */
    public static function getSeriesCollection(string $brand): Collection
    {
        return static::distinct()->where('brand', $brand)
            ->get(['series'])->flatten()->map(function ($item) {
                return $item->getSeries();
            })->sort();
    }

    /**
     * @param  string  $brand
     * @param  string  $series
     * @return Collection
     */
    public static function getTypesCollection(string $brand, string $series): Collection
    {
        return static::distinct()->where('brand', $brand)->where('series', $series)
            ->get(['type'])->flatten()->map(function ($item) {
                return $item->getType();
            })->sort();
    }

    /**
     * @param  Builder  $query
     * @param  string  $brand
     * @return Builder
     */
    public function scopeBrand(Builder $query, string $brand): Builder
    {
        return $query->where('brand', $brand);
    }

    /**
     * @param  Builder  $query
     * @param  string  $series
     * @return Builder
     */
    public function scopeSeries(Builder $query, string $series): Builder
    {
        return $query->where('series', $series);
    }

    /**
     * @param  Builder  $query
     * @param  string  $type
     * @return Builder
     */
    public function scopeType(Builder $query, string $type): Builder
    {
        return $query->where('type', $type);
    }

    /**
     * @param  Builder  $query
     * @param  string  $type
     * @return Builder
     */
    public function scopeAction(Builder $query, string $type): Builder
    {
        return $query->where('action_type', $type);
    }

    /**
     * Get the id of the product
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->attributes['id'];
    }

    /**
     * Set the id
     *
     * @param  string  $id
     * @return $this
     */
    public function setId(string $id)
    {
        $this->attributes['id'] = $id;

        return $this;
    }

    /**
     * Get the sku
     *
     * @return string
     */
    public function getSku(): string
    {
        return $this->attributes['sku'];
    }

    /**
     * Set the sku
     *
     * @param  string  $sku
     * @return $this
     */
    public function setSku(string $sku)
    {
        $this->attributes['sku'] = $sku;

        return $this;
    }

    /**
     * Get the group
     *
     * @return string
     */
    public function getGroup(): string
    {
        return $this->attributes['group'];
    }

    /**
     * Set the group
     *
     * @param  string  $group
     * @return $this
     */
    public function setGroup(string $group)
    {
        $this->attributes['group'] = $group;

        return $this;
    }

    /**
     * Get the name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->attributes['name'];
    }

    /**
     * Set the name
     *
     * @param  string  $name
     * @return $this
     */
    public function setName(string $name)
    {
        $this->attributes['name'] = $name;

        return $this;
    }

    /**
     * Get the calculated formatted price
     *
     * @param  bool  $withDiscount
     * @param  float  $quantity
     * @return float
     */
    public function getPrice(bool $withDiscount, float $quantity = 1.00)
    {
        if ($this->isAction()) {
            return $this->getSpecialPrice() * $quantity;
        } else {
            $price = $this->attributes['price'];

            if ($withDiscount) {
                $price = $price - ($price * ($this->getDiscount() / 100));
            }

            return $price * $quantity;
        }
    }

    /**
     * Set the unit price
     *
     * @param  float  $price
     * @return $this
     */
    public function setPrice(float $price)
    {
        $this->attributes['price'] = $price;

        return $this;
    }

    /**
     * Is action
     *
     * @return bool
     */
    public function isAction(): bool
    {
        return $this->getActionType() !== "";
    }

    /**
     * Get the action type
     *
     * @return string
     */
    public function getActionType(): string
    {
        return ($this->attributes['action_type'] ?: "");
    }

    /**
     * Set the action type
     *
     * @param  string  $actionType
     * @return $this
     */
    public function setActionType(string $actionType)
    {
        $this->attributes['action_type'] = $actionType;

        return $this;
    }

    /**
     * Get the special price
     *
     * @return float
     */
    public function getSpecialPrice(): float
    {
        return ($this->attributes['special_price'] ?: 0.00);
    }

    /**
     * Set the special price
     *
     * @param  float|null  $price
     * @return $this
     */
    public function setSpecialPrice(float $price = null)
    {
        $this->attributes['special_price'] = $price;

        return $this;
    }

    /**
     * Get the discount
     *
     * @return float
     */
    public function getDiscount(): float
    {
        return (float) 10.0;
    }

    /**
     * Set the image name
     *
     * @param  string  $image
     * @return $this
     */
    public function setImage(string $image)
    {
        $this->attributes['image'] = $image;

        return $this;
    }

    /**
     * Get the image name
     *
     * @return string
     */
    public function getImage(): string
    {
        $image = $this->attributes['image'];

        if (str_contains($image, ["http://", "https://"])) {
            return $image;
        }

        return asset($this->image_path.$image);
    }

    /**
     * Set the brand
     *
     * @param  string  $brand
     * @return $this
     */
    public function setBrand(string $brand)
    {
        $this->attributes['brand'] = $brand;

        return $this;
    }

    /**
     * Get the brand
     *
     * @return string
     */
    public function getBrand(): string
    {
        return $this->attributes['brand'];
    }

    /**
     * Set the series
     *
     * @param  string  $series
     * @return $this
     */
    public function setSeries(string $series)
    {
        $this->attributes['series'] = $series;

        return $this;
    }

    /**
     * Get the series
     *
     * @return string
     */
    public function getSeries(): string
    {
        return $this->attributes['series'];
    }

    /**
     * Set the type
     *
     * @param  string  $type
     * @return $this
     */
    public function setType(string $type)
    {
        $this->attributes['type'] = $type;

        return $this;
    }

    /**
     * Get the type
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->attributes['type'];
    }

    /**
     * Set the alternate sku
     *
     * @param  string  $sku
     * @return $this
     */
    public function setAlternateSku(string $sku)
    {
        $this->attributes['alternate_sku'] = $sku;

        return $this;
    }

    /**
     * Get the alternate sku
     *
     * @return string
     */
    public function getAlternateSku(): string
    {
        return $this->attributes['alternate_sku'];
    }

    /**
     * Set the ean code
     *
     * @param  string  $ean
     * @return $this
     */
    public function setEan(string $ean)
    {
        $this->attributes['ean'] = $ean;

        return $this;
    }

    /**
     * Get the ean code
     *
     * @return string
     */
    public function getEan(): string
    {
        return $this->attributes['ean'];
    }

    /**
     * Set the stock code
     *
     * @param  string  $stockCode
     * @return $this
     */
    public function setStockCode(string $stockCode)
    {
        $this->attributes['stock_code'] = $stockCode;

        return $this;
    }

    /**
     * Get the stock code
     *
     * @return string
     */
    public function getStockCode(): string
    {
        return $this->attributes['stock_code'];
    }
}