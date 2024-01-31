<?php


use App\Models\NumerosEnLetras;

// Devuelve el id del usuario autenticado
function userID()
{
    return Auth()->user()->id;
}

// Devolver número en formato moneda con opciones para personalización
function money($number)
{
    return '$'.
            number_format($number, 0, ',', '.');
}

// Convertir numeros a letras
function numeroLetras($number)
{
    // 1-numero, 2-simbolo de moneda, 3-formato, 4-decimales / obligatorio P mayuscula en Pesos
    return NumerosEnLetras::convertir($number, 'Pesos', false, 'centavos');
}
