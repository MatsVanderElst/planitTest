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
  foreach ($allProducts as $product)
    if ($_SESSION['user']['favstore'] == 'delhaize') {
      $total += $product['price'] + 0.4;
    } elseif ($_SESSION['user']['favstore'] == 'carrefour') {
      $total += $product['price'] - 0.2;
    } elseif ($_SESSION['user']['favstore'] == 'colruyt') {
      $total += $product['price'] - 0.5;
    } elseif ($_SESSION['user']['favstore'] == 'alberthein') {
      $total += $product['price'] - 0.3;
    } else {
      $total += $product['price'];
    }
  ?>




  <?php if (!empty($_SESSION['list'])) : ?>
    <div class="cart__products">
      <?php foreach ($allProducts as $product) : ?>
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
            <?php if ($_SESSION['user']['favstore'] == 'delhaize') : ?>
              <p class="product__price-black"><?php echo $product['price'] + 0.4 ?></p>
            <?php elseif ($_SESSION['user']['favstore'] == 'carrefour') : ?>
              <p class="product__price-black"><?php echo $product['price'] - 0.2 ?></p>
            <?php elseif ($_SESSION['user']['favstore'] == 'colruyt') : ?>
              <p class="product__price-black"><?php echo $product['price'] - 0.5 ?></p>
            <?php elseif ($_SESSION['user']['favstore'] == 'alberthein') : ?>
              <p class="product__price-black"><?php echo $product['price'] - 0.3 ?></p>
            <?php else : ?>
              <p class="product__price-black"><?php echo $product['price'] ?></p>
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
        <a href="index.php?page=list">
          <button class="backButton">Back</button>
        </a>
        <form class="jsForm form" method="get" action="index.php?page=cart">
          <input type="hidden" value="confirm" name="action">
          <input type="hidden" value="menu" name="page">
          <input type="submit" value="confirm" class="submitButton">
        </form>
      </section>
    </div>
  <?php endif; ?>
</div>
