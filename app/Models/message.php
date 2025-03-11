<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class message extends Model
{
    protected $table = 'messages';
    protected $fillable = ['titel', 'bericht', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
