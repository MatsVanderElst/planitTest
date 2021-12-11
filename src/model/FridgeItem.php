<?php

use \Illuminate\Database\Eloquent\Model;

class FridgeItem extends Model
{
  public $timestamps = false;

  public function product()
  {
      return $this->belongsTo(Product::class);
  }

  
}
