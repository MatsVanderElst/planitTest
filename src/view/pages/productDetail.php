<h1 class="logintitle">
  <img src="./assets/images/title.svg" alt="mealplanner" class="titleImage">
</h1>
<article class="formcontent__productDetail">
    <div class="fridgeDetailHeader__container">
      <p class="fridgeDetailParagraph">Here’s an overview of the product's details.</p>
    </div>
            <li class="details">
                    <p class="DetailFridgeItem">name: <?php echo $product['product']; ?></p>
                    <p class="DetailFridgeItem">fat: <?php echo $product['fat']; ?></p>
                    <p class="DetailFridgeItem">sodium :<?php echo $product['sugar']; ?></p>
                    <p class="DetailFridgeItem">nutriscore :<?php echo $product['nutriscore']; ?></p>
            </li>
    <a href="index.php?page=fridge">
          <button class="backButton">Back</button>
    </a>
  </article>
  <!-- <input type="submit" value="fridgedelete" class="submitButton"> -->
