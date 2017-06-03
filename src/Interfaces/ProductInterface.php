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
    public function getId(): string;

    /**
     * Set the id
     *
     * @param  string  $id
     * @return $this
     */
    public function setId(string $id);

    /**
     * Get the sku
     *
     * @return string
     */
    public function getSku(): string;

    /**
     * Set the sku
     *
     * @param  string  $sku
     * @return $this
     */
    public function setSku(string $sku);

    /**
     * Get the group
     *
     * @return string
     */
    public function getGroup(): string;

    /**
     * Set the group
     *
     * @param  string  $group
     * @return $this
     */
    public function setGroup(string $group);

    /**
     * Get the name
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Set the name
     *
     * @param  string  $name
     * @return $this
     */
    public function setName(string $name);

    /**
     * Get the calculated formatted price
     *
     * @param  bool  $withDiscount
     * @param  float  $quantity
     * @return float
     */
    public function getPrice(bool $withDiscount, float $quantity = 1.00);

    /**
     * Set the unit price
     *
     * @param  float  $price
     * @return $this
     */
    public function setPrice(float $price);

    /**
     * Is action
     *
     * @return bool
     */
    public function isAction(): bool;

    /**
     * Get the action type
     *
     * @return string
     */
    public function getActionType(): string;

    /**
     * Set the action type
     *
     * @param  string  $actionType
     * @return $this
     */
    public function setActionType(string $actionType);

    /**
     * Get the special price
     *
     * @return float
     */
    public function getSpecialPrice(): float;

    /**
     * Set the special price
     *
     * @param  float|null  $price
     * @return $this
     */
    public function setSpecialPrice(float $price = null);

    /**
     * Get the discount
     *
     * @return float
     */
    public function getDiscount(): float;

    /**
     * Set the image name
     *
     * @param  string  $image
     * @return $this
     */
    public function setImage(string $image);

    /**
     * Get the image name
     *
     * @param  bool  $assetPath
     * @return string
     */
    public function getImage(bool $assetPath = true): string;

    /**
     * Set the brand
     *
     * @param  string  $brand
     * @return $this
     */
    public function setBrand(string $brand);

    /**
     * Get the brand
     *
     * @return string
     */
    public function getBrand(): string;

    /**
     * Set the series
     *
     * @param  string  $series
     * @return $this
     */
    public function setSeries(string $series);

    /**
     * Get the series
     *
     * @return string
     */
    public function getSeries(): string;

    /**
     * Set the type
     *
     * @param  string  $type
     * @return $this
     */
    public function setType(string $type);

    /**
     * Get the type
     *
     * @return string
     */
    public function getType(): string;

    /**
     * Set the alternate sku
     *
     * @param  string  $sku
     * @return $this
     */
    public function setAlternateSku(string $sku);

    /**
     * Get the alternate sku
     *
     * @return string
     */
    public function getAlternateSku(): string;

    /**
     * Set the ean code
     *
     * @param  string  $ean
     * @return $this
     */
    public function setEan(string $ean);

    /**
     * Get the ean code
     *
     * @return string
     */
    public function getEan(): string;
    /**
     * Set the stock code
     *
     * @param  string  $stockCode
     * @return $this
     */
    public function setStockCode(string $stockCode);

    /**
     * Get the stock code
     *
     * @return string
     */
    public function getStockCode(): string;

    /**
     * Set the catalog group.
     *
     * @param  string  $group
     * @return string
     */
    public function setCatalogGroup(string $group);

    /**
     * Get the catalog group.
     *
     * @return string
     */
    public function getCatalogGroup(): string;

    /**
     * Set the catalog index.
     *
     * @param  string  $index
     * @return string
     */
    public function setCatalogIndex(string $index);

    /**
     * Get the catalog index.
     *
     * @return string
     */
    public function getCatalogIndex(): string;
}