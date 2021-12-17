<div class="cart__container">
  <h1 class="cart__title">
    <a href="index.php?page=menu">
      <img src="./assets/images/title.svg" alt="mealplanner" class="titleImage-cart">
    </a>
  </h1>

  <div>
    <?php if (empty($_SESSION['list'])) : ?>
      <div class="empty">
        <p class="emptyP"> Your shopping list is still empty</p>
        <a class="emptyA" href="index.php?page=list">click to create a shopping list</a>
      </div>
    <?php endif; ?>
  </div>



  <?php
  $total = 0;
  foreach ($selectedProducts as $product) {
    if (is_null($product['discountStorePrice']) == false) {
      $total += $product['discountStorePrice'];
    } else {
      $total += $product['storePrice'];
    }
  }
  ?>




  <?php if (!empty($_SESSION['list'])) : ?>
    <div class="cart__products">
      <?php foreach ($selectedProducts as $product) : ?>
        <div>
          <div class="single__product">
            <div>
              <span>
                <a href="index.php?page=cart&action=delete&deleteProduct=<?php echo $product['id'] ?>">
                  <span class="material-icons bin">
                    delete
                  </span>
                </a>
              </span>
            </div>
            <p class="single__product-name"><?php echo $product['product'] ?></p>

            <?php if ($product['discountStorePrice'] != 0) : ?>
              <p class="product__price-black dicountColor"><?php echo $product['discountStorePrice'] ?></p>
            <?php else : ?>
              <p class="product__price-black"><?php echo $product['storePrice'] ?></p>
            <?php endif; ?>
          </div>
        </div>
        <hr class="stroke">
      <?php endforeach; ?>
    </div>

  <?php endif; ?>


  <?php if (!empty($_SESSION['list'])) : ?>
    <div class="totalDiv">
      <section class="total__cart">
        <p>Total:</p>
        <p class="totalEcho"><?php echo $total ?></p>
      </section>

      <section class="buttons">
        <form class="jsForm form" method="get" action="index.php?page=cart">
          <label class="formlabel" for="listName"> add a name to save your list! use the same name to overwrite one!</label>
          <input class="input" name="listName" type="text" placeholder="christmas list">
          <input type="hidden" value="confirm" name="action">
          <input type="hidden" value="menu" name="page">
          <input type="submit" value="confirm" class="submitButton">
        </form>
        <a href="index.php?page=list">
          <button class="backButton">Back</button>
        </a>
      </section>
    </div>
  <?php endif; ?>
</div>
