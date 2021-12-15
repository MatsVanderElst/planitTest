<?php

use \Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  public $timestamps = false;
  protected $appends = ['nutriScore','storePrice', 'discountStorePrice'];

  public function fridgeItems()
  {
      return $this->hasMany(FridgeItems::class);
  }

  public function getNutriScoreAttribute(){
    if($this['fat'] == 0 && $this['sugar'] == 0){
      return 'A+';
    }elseif ($this['fat']>10){
      return 'C';
    }elseif ($this['fat']>=6) {
      return 'B';
    }else{
      return 'A';
    }
    
  }


  public function getStorePriceAttribute(){

      //als tijd toelaat -> refactoren naar switch
    if ($_SESSION['user']['favstore'] == 'delhaize') {
        return $this['price'] + 0.4;
    } elseif ($_SESSION['user']['favstore'] == 'carrefour') {
        return $this['price'] + 0.2;
    } elseif ($_SESSION['user']['favstore'] == 'colruyt') {
        return $this['price'] + 0.5;
    } elseif ($_SESSION['user']['favstore'] == 'alberthein') {
        return $this['price'] + 0.3;
    } else {
      return $this['price'];
    }

  }

  public function getDiscountStorePriceAttribute(){

   if ($this['discount_price'] == null) {
     return null;
   } else {
     if ($_SESSION['user']['favstore'] == 'delhaize') {
         return $this['discount_price'] + 0.4;
     } elseif ($_SESSION['user']['favstore'] == 'carrefour') {
         return $this['discount_price'] + 0.2;
     } elseif ($_SESSION['user']['favstore'] == 'colruyt') {
         return $this['discount_price'] + 0.5;
     } elseif ($_SESSION['user']['favstore'] == 'alberthein') {
         return $this['discount_price'] + 0.3;
     } else {
       return $this['discount_price'];
     }
   }


}
}
