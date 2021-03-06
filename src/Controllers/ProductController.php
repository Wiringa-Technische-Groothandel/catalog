<?php

namespace WTG\Catalog\Controllers;

use WTG\Http\Controllers\Controller;
use WTG\Catalog\Interfaces\ProductInterface;

/**
 * Product controller
 *
 * @package     WTG\Catalog
 * @subpackage  Controllers
 * @author      Thomas Wiringa  <thomas.wiringa@gmail.com>
 */
class ProductController extends Controller
{
    /**
     * Product detail page
     *
     * @param  string  $sku
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function view(string $sku)
    {
        $product = app()->make(ProductInterface::class)->where('sku', $sku)->first();

        if ($product === null) {
            return back()
                ->withErrors([
                    trans('catalog::productNotFound', ['sku', $sku])
                ]);
        }

        return view('catalog::product', compact('product'));
    }
}