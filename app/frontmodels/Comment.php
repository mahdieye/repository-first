<?php


namespace App\frontmodels;

//use Cviebrock\EloquentSluggable\Sluggable;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
//    use Sluggable;
    protected $fillable = ['name', 'email', 'body'];

}
