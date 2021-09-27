<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UrlLog extends Model
{
    use HasFactory;

    protected $table    = "url_logs";

    protected $fillable = [
        'url_id',
        'status_code',
        'data',
    ];

    /**
     * Traz a url.
     */
    public function url()
    {
        return $this->belongsTo(Url::class);
    }
}
