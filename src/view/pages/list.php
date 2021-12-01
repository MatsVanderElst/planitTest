<div class="list__container">
  <h1 class="list__title">
    <img src="./assets/images/title.svg" alt="mealplanner" class="titleImage">
  </h1>

  <article>
    <section>
      <p class="list__welcome"><?php echo $_SESSION['user']['nickname'] ?>, <br> you have € <?php echo $_SESSION['user']['credit'] ?> left this week</p>
    </section>
    <section>
      <p class="list__text">Look for products to put on your list. <br> <br>
        The items you choose will be subtracted
        From your budget. </p>
    </section>
  </article>

  <article>
    <form method="get" action="index.php?page=list">
      <input type="hidden" name="page" value="list" />
      <input class="searchbar" type="text" name="product" placeholder="Bell Pepper" value="<?php if (!empty($_GET['product'])) echo $_GET['product'];?>" />
      <button type="submit">Search</button>
    </form>
  </article>



  <article class="product__list">
    <?php foreach ($products as $product) : ?>
      <div class="product__single">
        <button class="add" type="submit" value="list">
          <span class="material-icons">
            post_add
          </span>
        </button>
        <p class="product__name"><?php echo $product['product'] ?></p>
        <p class="product__price"><?php echo $product['price'] ?></p>
      </div>
    <?php endforeach; ?>
  </article>
</div>
