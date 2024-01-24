<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'descripcion',
        'precio_compra',
        'precio_venta',
        'stock',
        'stock_minimo',
        'codigo_barras',
        'fecha_vencimiento',
        'active',
        'category_id',
    ];

    // relacion polimorfica de imagen
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // atributos
    protected function stockLabel(): Attribute
    {
        return Attribute::make(
            get: function () {
                return $this->attributes['stock'] >= $this->attributes['stock_minimo'] ?
                    '<span class="badge badge-pill badge-success">'.$this->attributes['stock'].'</span>' :
                    '<span class="badge badge-pill badge-danger">'.$this->attributes['stock'].'</span>';
            }
        );
    }

    protected function precio(): Attribute
    {
        return Attribute::make(
            get: function () {
                return '<b>$'.number_format($this->attributes['precio_venta'], 0, ',', '.').'</b>';
            }
        );
    }

    protected function activeLabel(): Attribute
    {
        return Attribute::make(
            get: function () {
                return $this->attributes['active'] ? '<span class="badge badge-success">Activo</span>' :
                    '<span class="badge badge-warning">Inactivo</span>';
            }
        );
    }

    protected function imagen(): Attribute
    {
        return Attribute::make(
            get: function () {
                return $this->image ? Storage::url('public/'.$this->image->url) : asset('no-image.png');
            }
        );
    }
}
