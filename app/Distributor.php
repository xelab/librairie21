<?php 

namespace App;

use Illuminate\Database\Eloquent\Model;

class Distributor extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'distributors';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name','address','city','zip', 'phone', 'mail'];

    /**
     * Distributor books
     */
    public function books()
    {
        return $this->hasMany('App\Book');
    }

}
