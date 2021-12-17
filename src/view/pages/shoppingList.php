<div class="shoppingList__container">
  <h1 class="shoppingList__title">
    <a href="index.php?page=menu">
      <img src="./assets/images/title.svg" alt="mealplanner" class="titleImage-shoppingList">
    </a>
  </h1>
  <div>
  <?php if (empty($shoppingLists)) : ?>  
    <div class="empty">
        <p class="emptyP"> Your shopping list is still empty</p>
        <a class="emptyA" href="index.php?page=list">click to create a shopping list</a>
        <?php endif; ?>
        <?php if (!empty($shoppingLists)) : ?>
          <p class="emptyP"> Your saved shopping lists are</p>
          <?php foreach($shoppingLists as $shoppingList):?>
            <div class="list_listItem">
                <a class="emptyA" href="index.php?page=listDetail&listId=<?php echo $shoppingList['id']; ?>"><p><?php echo $shoppingList['name']; ?></p></a>
                <span>
                <a href="index.php?page=shoppingList&action=delete&listId=<?php echo $shoppingList['id'] ?>">
                  <span class="material-icons bin">
                    delete
                  </span>
                </a>
              </span>
            </div>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>    

  </div>
</div>