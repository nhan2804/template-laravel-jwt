<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportTicket extends Model
{
    protected $appends = ['_id'];
    public function getIdAttribute()
    {
        return $this->attributes['id_import_ticket'];
    }
    protected $primaryKey = "id_import_ticket";
    protected $fillable = ['from', 'to', 'from_storage_id', 'to_storage_id', 'note', 'status', 'user_id', 'data'];
    protected $guarded = ['id_import_ticket'];
    protected $casts = [
        'data' => 'object',
    ];
    use HasFactory;
}
