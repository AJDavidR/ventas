<?php

// Devuelve el id del usuario autenticado

use App\Models\NumerosEnLetras;

function userID()
{
    return  Auth()->user()->id;
}

// Devolver número en formato moneda con opciones para personalización
function money($number)
{
    return  '<span style="color: rgb(2, 210, 2);">$</span>' .
        ' <b>' . number_format($number, 0, ',', '.') . '</b>';
}

// Convertir numeros a letras
function numeroLetras($number)
{
    return NumerosEnLetras::convertir($number, 'pesos', false, 'centavos');
}
