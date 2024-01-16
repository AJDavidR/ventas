<?php

// Devuelve el id del usuario autenticado
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
