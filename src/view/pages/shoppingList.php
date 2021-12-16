<div class="shoppingList__container">
  <h1 class="shoppingList__title">
    <a href="index.php?page=menu">
      <img src="./assets/images/title.svg" alt="mealplanner" class="titleImage-shoppingList">
    </a>
  </h1>

  <div>
      <div class="empty">
        <p class="emptyP"> Your shopping list is still empty</p>
        <a class="emptyA" href="index.php?page=list">click to create a shopping list</a>
        <?php if (!empty($shoppingLists)) : ?>
            <p class="emptyP"> Your saved shopping lists are</p>
            <?php foreach($shoppingLists as $shoppingList):?>
                <a class="emptyA" href="index.php?page=list">click to create a shopping list</a>
            <?php endforeach; ?>
        <?php endif; ?>
      </div>    

  </div>
</div>