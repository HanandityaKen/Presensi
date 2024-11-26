<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Presence extends Model
{
    protected $table = 'presence';

    protected $fillable = [
        'id',
        'user_id',
        'location',
        'image_url_in',
        'clock_in_time',
        'image_url_out',
        'clock_out_time',
        'work_place',
    ];

    public $timestamps = false;

    const CREATED_AT = 'created_at';
    const UPDATED_AT = null; 

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
