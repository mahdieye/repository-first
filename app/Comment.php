<?php


namespace App;

use Illuminate\Database\Eloquent\Model;

class comment extends Model
{

    protected  $fillable = ['body', 'name', 'email','status'];

public function article()
{
    return $this->belongsto(Article::class);
}

}
