<?php

use \Illuminate\Database\Eloquent\Model;

class DiscountProduct extends Model
{
  public $timestamps = false;
  protected $appends = ['nutriScore'];

  public function fridgeItems()
  {
    return $this->hasMany(FridgeItems::class);
  }

  public function getNutriScoreAttribute()
  {
    if ($this['fat'] == 0 && $this['sugar'] == 0) {
      return 'A+';
    } elseif ($this['fat'] > 10) {
      return 'C';
    } elseif ($this['fat'] >= 6) {
      return 'B';
    } else {
      return 'A';
    }
  }
}
