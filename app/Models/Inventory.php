<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $appends = ['_id'];
    public function getIdAttribute()
    {
        return $this->attributes['id_inventorie'];
    }
    protected $primaryKey = "id_inventorie";
    protected $table = "inventories";
    protected $fillable = ['quantity', 'product_id', 'storage_id'];
    protected $guarded = ['id_inventories'];
    public function product()
    {
        return $this->belongsTo(Product::class, "product_id", "id_product");
    }
    use HasFactory;
}
