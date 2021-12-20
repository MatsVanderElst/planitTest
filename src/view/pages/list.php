<div class="list__container">
  <h1 class="list__title">
    <a href="index.php?page=menu">
      <img src="./assets/images/title.svg" alt="mealplanner" class="titleImage-list">
    </a>
  </h1>

  <article class="welcome-list">
    <section>
      <p class="list__welcome"><?php echo $_SESSION['user']['nickname'] ?>, <br> you have € <?php echo number_format((float)$_SESSION['overschot'], 2, '.', ''); ?> left this week</p>
    </section>
    <section>
      <p class="list__text">Look for products to put on your list. <br> <br>
        The items you choose will be subtracted
        From your budget. </p>
    </section>
  </article>

  <article class="search__basket">
    <section>
      <form class="product__form" method="get" action="index.php?page=list">
        <input type="hidden" name="page" value="list" />
        <input class="searchbar" type="text" name="product" placeholder="Apple" value="<?php if (!empty($_GET['product'])) echo $_GET['product']; ?>" />
        <button class="formButton" type="submit">Search</button>
      </form>
    </section>
    <section>
      <a href="index.php?page=cart" class="basket">
        <span class="material-icons cart">
          shopping_cart
        </span>
        <span class="amountCart"><?php if (!empty($_SESSION['list'])) echo count($_SESSION['list']) ?></span>
      </a>
    </section>
  </article>


  <div class="product__list-container">
    <article class="product__list">
      <?php foreach ($products as $product) : ?>
        <div class="product__single">

          <form method="get" action="index.php?page=list" class="price">
            <input type="hidden" value="list" name="page">
            <input type="hidden" value="<?php echo $product['id'] ?>" name="addProduct">

            <button class="add" type="submit" value="list">
              <span class="material-icons">
                post_add
              </span>
            </button>

          </form>
          <p class="product__name"><?php echo $product['product'] ?></p>
          <?php if ($product['discountStorePrice'] != 0) : ?>

            <p class="product__price-red"><?php echo number_format((float)$product['discountStorePrice'], 2, '.', ''); ?></p>
          <?php else : ?>
            <p class="product__price"><?php echo number_format((float)$product['storePrice'], 2, '.', ''); ?></p>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>

    </article>
  </div>

  <ul class="pagination">
    <?php for ($page = 1; $page <= $totalPages; $page++) : ?>
      <li>
        <?php if ($currentPage == $page) : ?>
          <span class="pagination__link-span"><?php echo $page; ?></span>
        <?php else : ?>
          <a class="pagination__link" href="index.php?<?php
                                                      $params['page'] = 'list';
                                                      $params['p'] = $page;
                                                      echo http_build_query($params);
                                                      ?>"><?php echo $page; ?></a>
        <?php endif; ?>
      </li>
    <?php endfor; ?>
  </ul>
</div>
