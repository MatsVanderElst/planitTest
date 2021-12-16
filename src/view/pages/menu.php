<div class="menu__container">
  <h1 class="menu__title">
    <img src="./assets/images/title.svg" alt="mealplanner" class="titleImage">
  </h1>
  <h2 class="menu__subtitle"> <?php echo $_SESSION['user']['nickname'] ?> , you have € <?php echo $_SESSION['user']['credit'] ?> left </h2>
  <p class="menu__paragraph">Create or view your shopping lists or check out what food you still have at home!</p>
  <nav class="navigation__container">
    <div class="main__buttons">
      <div class="list__button">
        <a href="index.php?page=list">
          <p>Make a shoppig List</p>
          <img src="assets/images/listIcon.svg" alt="shopping list icon">
        </a>
      </div>
      <div class="products__button">
        <a href="index.php?page=fridge">
          <p>products at home</p>
          <img src="assets/images/houseIcon.svg" alt="home icon">
        </a>
      </div>
    </div>
    <div class="secondary__buttons">
      <p class="discounts__title">Discouts</p>
      <div class="discounts__button">
        <a href="index.php?page=discountProduct">
          <img src="assets/images/ticketIcon.svg" alt="ticket icon">
        </a>
      </div>
      <p class="recipes__title">Recipess</p>
      <div class="recipes__button">
        <a href="index.php?page=shoppingList">
          <img src="assets/images/hamburgerIcon.svg" alt="hamburger icon">
        </a>
      </div>
    </div>
  </nav>
  <footer>
    <a href="index.php?page=settings">
      <img class="settings__button" src="assets/images/settingsIcon.svg" alt="settings icon">
    </a>
  </footer>
</div>
