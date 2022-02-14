<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class shopping_cart extends Model
{
    use SoftDeletes;

    public $table = 'shopping_carts';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    protected $dates = ['deleted_at'];

    public function shopping_cart() {
        return $this->hasOne('\App\Item','id')->orderBy('name','ASC');
    }
}
