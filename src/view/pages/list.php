<div class="list__container">
  <h1 class="list__title">
    <img src="./assets/images/title.svg" alt="mealplanner" class="titleImage">
  </h1>

  <article>
    <section>
      <p><?php echo $_SESSION['user']['nickname'] ?>, <br> you have € <?php echo $_SESSION['user']['credit'] ?></p>
    </section>
    <section>
      <p>Look for products to put on your list. <br> <br>

        The items you choose will be subtracted
        From your budget. </p>
    </section>
  </article>
</div>
