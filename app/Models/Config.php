<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Config extends Model
{
    protected $table        = 'config';
    protected $primaryKey   = 'id';
    protected $guarded      = ['id'];

    public function provinsi(): BelongsTo
    {
        return $this->belongsTo(Provinsi::class, 'kode_propinsi', 'kode');
    }
}
