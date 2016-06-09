<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'collections';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'publisher_id'];

    /**
     * Collection books
     */
    public function books()
    {
        return $this->hasMany('App\Book');
    }

    /**
     * Publisher
     */
    public function publisher()
    {
        return $this->belongsTo('App\Publisher');
    }
}
