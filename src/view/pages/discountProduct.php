<div class="list__container">
  <h1 class="list__title">
    <a href="index.php?page=menu">
      <img src="./assets/images/title.svg" alt="mealplanner" class="titleImage-list">
    </a>
  </h1>

  <article class="welcome-list">
    <section>
      <p class="list__welcome"><?php echo $_SESSION['user']['nickname'] ?>, <br> you have € <?php echo $_SESSION['overschot'] ?> left this week</p>
    </section>
    <section>
      <p class="list__text">Look for products to put on your list. <br> <br>
        The items you choose will be subtracted
        From your budget. </p>
    </section>
  </article>
  <article>
    <a href="index.php?page=cart" class="basket">
      <span class="material-icons cart">
        shopping_cart
      </span>
      <span class="amountCart"><?php if (!empty($_SESSION['list'])) echo count($_SESSION['list']) ?></span>
    </a>
  </article>




  <div class="product__list-container">
    <article class="product__list">
      <?php foreach ($discProducts as $discProduct) : ?>
        <div class="product__single">

          <form method="get" action="index.php?page=list" class="price">
            <input type="hidden" value="list" name="page">
            <input type="hidden" value="<?php echo $discProduct['id'] ?>" name="addDiscProduct">
            <button class="add" type="submit" value="list">
              <span class="material-icons">
                post_add
              </span>
            </button>
          </form>

          <p class="product__name"><?php echo $discProduct['product'] ?></p>

          <p class="product__price-disc"><?php echo number_format((float)$discProduct['storePrice'], 2, '.', ''); ?></p>
          <p class="product__price-red"><?php echo number_format((float)$discProduct['discountStorePrice'], 2, '.', ''); ?></p>
        </div>
      <?php endforeach; ?>
    </article>
  </div>


</div>
