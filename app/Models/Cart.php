<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    // Agregar producto al carrito
    public static function add(Product $product)
    {

        // add the product to cart
        \Cart::session(userID())->add(array(
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->precio_venta,
            'quantity' => 1,
            'attributes' => array(),
            'associatedModel' => $product
        ));
        // dump(\Cart::getContent());
    }

    // obtener el contenido del carrito
    public static function getCart()
    {
        $cart = \Cart::session(userID())->getContent();
        return $cart->sort();
    }
}
