<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    use HasFactory;

    protected $fillable = [
        'url',
        'check_time',
        'monitorar',
    ];

    /**
     * Traz os logs da url.
     */
    public function logs()
    {
        return $this->hasMany(UrlLog::class);
    }
}
