<?php 

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'books';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['isbn','collection_id','publisher_id','price','released','title','summary','deposit','buy','distributor_id'];

}
