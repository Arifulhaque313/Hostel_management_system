<?php

namespace App\Actions;

use App\Models\Product;
use App\Models\Setting;
use Cart;

class Stock
{

    // decrease inividual product unit
    static function decrease_product_stock($id, $quantity = 1)
    {
        $product = Product::where('id', $id)->first();
        $product->stock -= $quantity;
        $product->save();
    }
    static function increase_product_stock($id, $quantity = 1)
    {
        $product = Product::where('id', $id)->first();
        $product->stock += $quantity;
        $product->save();
    }

    static function isAvailableStock($items = null)
    {
        if (Setting::get('stock')) {
            if ($items) {
                foreach ($items as $item) {
                    $product = Product::where('id', $item->product_id)->first();
                    if ($product && $product->status && $product->stock >= $item->quantity) {
                        continue;
                    } else {
                        return ['status' => false, 'message' => "$product->name only $product->stock items available"];
                    }
                }
                return ['status' => true];
            } else {
                $items = Cart::getContent();
                foreach ($items as $item) {
                    $product = Product::where('id', $item->id)->first();
                    if ($product && $product->stock >= $item->quantity) {
                        continue;
                    } else {
                        return ['status' => false, 'message' => "$product->name only $product->stock items available"];
                    }
                }
                return ['status' => true];
            }
        }else{
            return ['status' => true];
        }
    }

    static function decrease_stock($items = null)
    {
        if(Setting::get('stock')){
            if ($items) {
                foreach ($items as $item) {
                    self::decrease_product_stock($item->product_id, $item->quantity);
                }
            } else {
                $items = Cart::getContent();
                foreach ($items as $item) {
                    self::decrease_product_stock($item->id, $item->quantity);
                }
            }
        }
    }
}
