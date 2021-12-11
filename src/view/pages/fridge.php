<h1 class="logintitle">
  <img src="./assets/images/title.svg" alt="mealplanner" class="titleImage">
</h1>
<form class="creditform jsForm" action="index.php?page=credit" method="post">
  <input type="hidden" name="action" value="credit">
  <article class="formcontent__fridge">
    <img src="./assets/images/hamburger.svg" alt="hamburger illustration" class="creditburger">
    <div class="fridgeHeader__container">
      <p class="fridgeSubTitle"> <?php echo $_SESSION['user']['nickname'] ?>, There are <?php echo $fridgeItemCount ?>, item’s in your fridge </p>
      <p class="fridgeParagraph">Here’s an overview of the products you Have at home. Tap the product to see it’s details.</p>
    </div>
    <ul>
        <?php foreach ($fridge as $fridgeItem) : ?>
            <li class="fridgeItem">
                <a>
                    <p class="fridgeItem__name"><?php echo $fridgeItem->product['product']  /* TODO check relative database hoofdstuk vr naam */; ?></p>
                    <p class="fridgeItem__quantity"><?php echo $fridgeItem['quantity']; ?></p>
                    <p class="fridgeItem__expiration date"><?php echo $fridgeItem['expiration_date']; ?></p> 
                </a>
                <span>
                <a href="index.php?page=fridge&action=use&productId=<?php echo $fridgeItem['id'] ?>">
                  <span class="material-icons bin">
                    delete
                  </span>
                </a>
              </span>
            </li>
        <?php endforeach; ?>
    </ul>
    
  </article>
  <!-- <input type="submit" value="fridgedelete" class="submitButton"> -->
</form>
<a href="index.php?page=menu">
      <button class="backButton">Back</button>
</a>
