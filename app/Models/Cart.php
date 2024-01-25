<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    // Agregar producto al carrito
    public static function add(Product $product)
    {
        $iva = 19;

                // solo ejemplo para hacer la prueba
        // $itemCondition1 = new \Darryldecode\Cart\CartCondition(array(
        //     'name' => 'IVA 19%',
        //     'type' => 'tax',
        //     'value' => -$iva.'%',
        // ));


        // add the product to cart
        \Cart::session(userID())->add([
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->precio_venta,
            'quantity' => 1,
            'attributes' => [],
            'associatedModel' => $product,
            // 'conditions' => [$itemCondition1]
        ]);
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

    // Devolver subTotal
    public static function getSubTotal()
    {
        return \Cart::session(userID())->getSubTotal();
    }

    // Decrementar total
    public static function decrements($id)
    {
        \Cart::session(userID())->update($id, [
            'quantity' => -1,
        ]);
    }

    // Incrementar total
    public static function increments($id)
    {
        \Cart::session(userID())->update($id, [
            'quantity' => 1,
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

    // Total articulos
    public static function totalArticulos()
    {
        return \Cart::session(userID())->getTotalQuantity();
    }

}
