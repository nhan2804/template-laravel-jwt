<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Storage extends Model
{
    protected $appends = ['_id'];
    public function getIdAttribute()
    {
        return $this->attributes['id_storage'];
    }
    protected $primaryKey = "id_storage";
    protected $fillable = ['name', 'desc', 'owner_id', 'project_id', 'type'];
    protected $guarded = ['id_storage'];
    use HasFactory;
}
