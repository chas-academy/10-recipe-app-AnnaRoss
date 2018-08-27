<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class CustomList extends Model
{
    protected $table = 'lists';

    protected $fillable = [
        'title', 'recipes_by_id', 'user_id' 
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
