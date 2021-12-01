  <?php
  $total = 0;
  foreach ($selectedProducts as $product)
    $total += $product[0]['price'];
  ?>

  <?php if (!empty($_SESSION['list'])) : ?>
    <div class="totalFlex marginTop">
      <section class="totalFlex">
        <p class="space totalStyle">Total</p>
        <p class="space evenMoreSpace"><?php echo $total ?></p>
      </section>
    </div>
  <?php endif; ?>
