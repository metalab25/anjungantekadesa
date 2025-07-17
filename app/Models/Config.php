<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Config extends Model
{
    protected $table        = 'config';
    protected $primaryKey   = 'id';
    protected $guarded      = ['id'];

    /**
     * Get the user that owns the Config
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function provinsi(): BelongsTo
    {
        return $this->belongsTo(Provinsi::class, 'kode_propinsi', 'kode');
    }
}
