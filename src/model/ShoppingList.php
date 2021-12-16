<?php

use \Illuminate\Database\Eloquent\Model;

class ShoppingList extends Model
{
  public $timestamps = false;

  public function user()
  {
      return $this->belongsTo(User::class);
  }




}
?>