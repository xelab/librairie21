<?php 

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'authors';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['lastname','firstname','birthdate','deathdate'];

    /**
     * Author books
     */
    public function books()
    {
        return $this->belongsToMany('App\Book');
    }
}
