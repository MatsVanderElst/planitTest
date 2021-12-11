<?php

use \Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  public $timestamps = false;

  public function fridgeItems()
  {
      return $this->hasMany(FridgeItems::class);
  }
}
