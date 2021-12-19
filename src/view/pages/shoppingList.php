<div class="shoppingList__container">
  <h1 class="shoppingList__title">
    <a href="index.php?page=menu">
      <img src="./assets/images/title.svg" alt="mealplanner" class="titleImage-shoppingList">
    </a>
  </h1>


  <?php if ($shoppingLists->count() == 0) : ?>
    <div class="noListst">
      <p class="emptyP"> Your shopping list is still empty</p>
      <a class="emptyA" href="index.php?page=list">click to create a shopping list</a>
    </div>
  <?php endif; ?>




  <?php if ($shoppingLists->count() != 0) : ?>
    <div class="shopListContainer">

      <p class="allListTitle"> Your saved shopping lists.</p>

      <div class="item__container">
        <?php foreach ($shoppingLists as $shoppingList) : ?>
          <a class="shopListLink" href="index.php?page=listDetail&listId=<?php echo $shoppingList['id']; ?>">
            <div class="list_listItem">

              <p class="listTitle"><?php echo $shoppingList['name']; ?></p>
              <img src="assets/images/listIcon.svg" alt="shopping list icon" width="40">

              <span>
                <a class="deleteList" href="index.php?page=shoppingList&action=delete&listId=<?php echo $shoppingList['id'] ?>">
                  Delete list
                </a>
              </span>
            </div>
          </a>
        <?php endforeach; ?>
      </div>
    </div>
  <?php endif; ?>

  <a href="index.php?page=menu">
    <button class="backButton">Back</button>
  </a>

</div>

</div>
