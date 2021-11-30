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
</div>
