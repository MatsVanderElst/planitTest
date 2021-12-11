<h1 class="logintitle">
  <img src="./assets/images/title.svg" alt="mealplanner" class="titleImage">
</h1>
<article class="formcontent__fridge">
   
    <div class="fridgeDetailHeader__container">
      <p class="fridgeDetailParagraph">Here’s an overview of the product's details.</p>
    </div>
    <ul>
            <li class="details">
                <a>
                    <p class="fridgeItem__name">name: <?php echo $product['product']; ?></p>
                    <p class="fridgeItem__fat">fat: <?php echo $product['fat']; ?></p>
                    <p class="fridgeItem__sodium">sodium :<?php echo $product['sugar']; ?></p>
                    <p class="fridgeItem__nutriScore">nutriscore :<?php echo $product['nutriscore']; ?></p>
                </a>
            </li>
    </ul>
    
  </article>
  <!-- <input type="submit" value="fridgedelete" class="submitButton"> -->
<a href="index.php?page=fridge">
      <button class="backButton">Back</button>
</a>
