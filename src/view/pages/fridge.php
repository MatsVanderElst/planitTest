<div class="fridgeBackroundContainer">
  <h1 class="logintitle">
    <img src="./assets/images/title.svg" alt="mealplanner" class="fridgeTitleImage">
  </h1>
  <article class="formcontent__fridge">
    <img src="./assets/images/hamburger.svg" alt="hamburger illustration" class="fridgeburger">
    <div class="fridgeHeader__container">
      <p class="fridgeSubTitle"> <?php echo $_SESSION['user']['nickname'] ?>, There are <?php echo $fridgeItemCount ?> item’s in your fridge </p>
      <p class="fridgeParagraph">Here’s an overview of the products you Have at home. Tap the name to see it’s details.</p>
    </div>
    <ul class="productsList">
      <?php if ($fridgeItemCount == 0): ?>
     <div class="empty">
       <p class="emptyP"> Your fridge is still empty</p>
       <a class="emptyA" href="index.php?page=list">click to add items to it</a>
     </div>
   <?php endif; ?>

      <?php foreach ($fridge as $fridgeItem) : ?>
        <li class="fridgeItem">
          <a>
            <a  href="index.php?page=productDetail&detailedProduct=<?php echo $fridgeItem->product['id'] ?>">
              <p class="fridgeItem__name"><?php echo $fridgeItem->product['product']; ?></p>
            </a>
            <p class="fridgeItem__quantity"><?php echo $fridgeItem['quantity']; ?></p>
            <div>
              <p class="fridgeItem__expiration date"><?php echo $fridgeItem['expiration_date']; ?></p>
          </a>
          <a href="index.php?page=editDate&fridgeItemId=<?php echo $fridgeItem['id']; ?>">
            <span class="material-icons bin">
              edit
            </span>
          </a>
</div>
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
<a href="index.php?page=menu">
  <button class="backButton">Back</button>
</a>
</article>
<!-- <input type="submit" value="fridgedelete" class="submitButton"> -->
</div>
