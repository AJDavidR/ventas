<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Stmt\Static_;

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

    // Devolver total
    public static function getTotal()
    {
        return \Cart::session(userID())->getTotal();
    }

    // Decrementar total
    public static function decrements($id)
    {
        \Cart::session(userID())->update($id, [
            'quantity' => -1
        ]);
    }

    // Incrementar total
    public static function increments($id)
    {
        \Cart::session(userID())->update($id, [
            'quantity' => 1
        ]);
    }

    // Eliminar item
    public static function removeItem($id)
    {
        \Cart::session(userID())->remove($id);
    }

    // Limpiar carrito
    public static function clear()
    {
        \Cart::session(userID())->clear();
    }
}
