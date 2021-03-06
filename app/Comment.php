<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'feed_id', 'comment',
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function feed() {
        return $this->belongsTo('App\Feed');
    }
}
