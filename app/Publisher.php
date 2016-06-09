<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'publishers';

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
    protected $fillable = ['name', 'address','city','zip','phone','mail'];

    /**
     * Publisher books
     */
    public function books()
    {
        return $this->hasMany('App\Book');
    }

    /**
     * Collections
     */
    public function collections()
    {
        return $this->hasMany('App\Collection');
    }
}
