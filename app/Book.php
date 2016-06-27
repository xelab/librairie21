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
    protected $fillable = ['isbn','collection_id','publisher_id','price','released','title','summary','deposit','buy','distributor_id', 'url_picture'];

    /**
     * Publisher
     */
    public function publisher()
    {
        return $this->belongsTo('App\Publisher');
    }

    /**
     * Distributor
     */
    public function distributor()
    {
        return $this->belongsTo('App\Distributor');
    }

    /**
     * Collection
     */
    public function collection()
    {
        return $this->belongsTo('App\Collection');
    }

    /**
     * Author
     */
    public function authors()
    {
        return $this->belongsToMany('App\Author');
    }

    /**
     * Tags
     */
    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }
}
