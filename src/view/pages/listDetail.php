<h1 class="loginDetailtitle">
  <img src="./assets/images/title.svg" alt="mealplanner" class="productDettailTitleImage">
</h1>
<article class="formcontent__listDetail">
    <div class="listDetailHeader__container">
    </div>
    <article class="welcome-listDetail">
    <section>
      <p class="listDetail__welcome"><?php echo $_SESSION['user']['nickname'] ?>, <br> you have € <?php echo $_SESSION['overschot'] ?> left this week</p>
    </section>
    <section>
      <p class="listDetail__text">Take a look at the products on your list. <br> <br>
        click on the cart to add it to your cart, the items you choose will be subtracted From your budget. </p>
    </section>
    </article>
    <div class="product__listDetail-container">
        <a href="index.php?page=list&listId=<?php echo $listId; ?>">
        <span class="material-icons cart listDetailIcon">
            shopping_cart
        </span>
        </a>
        <article class="product__listDetail">
        <?php foreach ($products as $product) : ?>
            <div class="product__singleDetail">
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

  

    <a href="index.php?page=shoppingList">
          <button class="listDetailBackButton">Back</button>
    </a>
  </article>