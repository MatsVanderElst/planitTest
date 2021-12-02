<div>
  <?php if (empty($_SESSION['list'])) : ?>
    <div>
      <p> Your shoppinglist is still empty</p>
      <a href="index.php?page=list">make A shoppinglist</a>
    </div>
  <?php endif; ?>

  <?php
  $total = 0;
  foreach ($selectedProducts as $product)
    $total += $product[0]['price'];
  ?>


  <?php if (!empty($_SESSION['list'])) : ?>
    <?php foreach ($selectedProducts as $product) : ?>
      <div>
        <div>
          <div>
            <span>
              <a href="index.php?page=cart&action=delete&product_product=<?php echo array_search($product, $selectedProducts) ?>">
                <span class="material-icons bin">
                  delete
                </span>
              </a>
            </span>
          </div>
          <p><?php echo $product[0]['product'] ?></p>
          <p><?php echo $product[0]['price'] ?></p>
        </div>
      </div>
      <hr class="stroke">
    <?php endforeach; ?>
  <?php endif; ?>


  <?php if (!empty($_SESSION['list'])) : ?>
    <div>

      <section>
        <p>Total</p>
        <p><?php echo $total ?></p>
      </section>

      <a href="index.php?page=menu">confirm</a>
    </div>
  <?php endif; ?>

</div>
