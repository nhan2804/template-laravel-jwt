<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExportTicket extends Model
{


    protected $primaryKey = "id_export_ticket";
    protected $fillable = ['from', 'to', 'from_storage_id', 'to_storage_id', 'note', 'status', 'user_id', 'data'];
    protected $guarded = ['id_export_ticket'];
    protected $casts = [
        'data' => 'object',
    ];
    protected $appends = ['_id'];
    public function getIdAttribute()
    {
        return $this->attributes['id_export_ticket'];
    }
    public function getDataAttribute()
    {
        return json_decode($this->attributes['data']);
    }
    use HasFactory;
}
