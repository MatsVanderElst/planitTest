<h1 class="logintitle">
  <img src="./assets/images/title.svg" alt="mealplanner" class="productDettailTitleImage">
</h1>
<article class="formcontent__productDetail">

  <p class="fridgeDetailTitle">Here’s an overview of the product's details.</p>

  <div class="details">
    <p class="DetailFridgeItem-title"><?php echo $product['product']; ?></p>
    <span class="infoContainer">
      <p class="DetailFridgeItem">fat: <?php echo $product['fat']; ?></p>
      <p class="DetailFridgeItem">sodium :<?php echo $product['sugar']; ?></p>
      <p class="DetailFridgeItem">nutriscore :<?php echo $product['nutriscore']; ?></p>
    </span>
    <a href="index.php?page=fridge">
      <button class="submitButton extr">Back</button>
    </a>
  </div>

</article>
<!-- <input type="submit" value="fridgedelete" class="submitButton"> -->
