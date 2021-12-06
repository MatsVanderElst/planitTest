<div class="cart__container">
  <div>
    <?php if (empty($_SESSION['list'])) : ?>
      <div>
        <p> Your shoppinglist is still empty</p>
        <a href="index.php?page=list">make A shoppinglist</a>
      </div>
    <?php endif; ?>
  </div>

  <?php
  $total = 0;
  foreach ($selectedProducts as $product)
    if ($_SESSION['user']['favstore'] == 'delhaize') {
      $total += $product[0]['price'] + 0.4;
    } elseif ($_SESSION['user']['favstore'] == 'carrefour') {
      $total += $product[0]['price'] - 0.2;
    } elseif ($_SESSION['user']['favstore'] == 'colruyt') {
      $total += $product[0]['price'] - 0.5;
    } elseif ($_SESSION['user']['favstore'] == 'alberthein') {
      $total += $product[0]['price'] - 0.3;
    } else {
      $total += $product[0]['price'];
    }
  ?>



  <div class="cart__products">
    <?php if (!empty($_SESSION['list'])) : ?>
      <?php foreach ($selectedProducts as $product) : ?>
        <div>
          <div class="single__product">
            <div>
              <span>
                <a href="index.php?page=cart&action=delete&product_product=<?php echo array_search($product, $selectedProducts) ?>">
                  <span class="material-icons bin">
                    delete
                  </span>
                </a>
              </span>
            </div>
            <p class="single__product-name"><?php echo $product[0]['product'] ?></p>
            <?php if ($_SESSION['user']['favstore'] == 'delhaize') : ?>
              <p class="product__price-black"><?php echo $product[0]['price'] + 0.4 ?></p>
            <?php elseif ($_SESSION['user']['favstore'] == 'carrefour') : ?>
              <p class="product__price-black"><?php echo $product[0]['price'] - 0.2 ?></p>
            <?php elseif ($_SESSION['user']['favstore'] == 'colruyt') : ?>
              <p class="product__price-black"><?php echo $product[0]['price'] - 0.5 ?></p>
            <?php elseif ($_SESSION['user']['favstore'] == 'alberthein') : ?>
              <p class="product__price-black"><?php echo $product[0]['price'] - 0.3 ?></p>
            <?php else : ?>
              <p class="product__price-black"><?php echo $product[0]['price'] ?></p>
            <?php endif; ?>
          </div>
        </div>
        <hr class="stroke">
      <?php endforeach; ?>
    <?php endif; ?>
  </div>

  <?php if (!empty($_SESSION['list'])) : ?>
    <div>
      <section class="total__cart">
        <p>Total:</p>
        <p class="totalEcho"><?php echo $total ?></p>
      </section>

      <section class="buttons">
        <a href="index.php?page=list">
          <button class="backButton">Back</button>
        </a>
        <form class="jsForm form" method="get" action="index.php?page=cart">
          <input type="hidden" value="true" name="confirm">
          <input type="hidden" value="menu" name="page">
          <a href="index.php?page=menu">
            <input type="submit" value="confirm" class="submitButton">
          </a>
        </form>
      </section>
    </div>
  <?php endif; ?>
</div>
