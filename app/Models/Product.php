<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $appends = ['_id'];
    public function getIdAttribute()
    {
        return $this->attributes['id_product'];
    }
    protected $primaryKey = "id_product";
    protected $fillable = ['name', 'extra', 'image', 'desc'];
    protected $guarded = ['id_product'];
    use HasFactory;
}
