<div class="editDateContainer">
<h1 class="logintitle">
  <img src="./assets/images/title.svg" alt="mealplanner" class="titleImage">
</h1>
<article class="formcontent__editDate">
   
    <div class="editDateHeader__container">
      <p class="feditDateParagraph">Here you can edit the expiration date of this <?php echo $fridgeItem->product['product'] ?></p>
    </div>
    <p>the current expiration date of this product is: <?php echo $fridgeItem['expiration_date'] ?></p>

    <form class="editDate_form" method="get" action="index.php?">
        <input name="action" type="hidden" value="editDate">
        <input name="page" type="hidden" value="editDate">
        <input name="fridgeItemId" type="hidden" value="<?php echo $fridgeItem['id'] ?>">
        <input name="newDate" type="date" value="<?php echo $fridgeItem['expiration_date'] ?>">
        <input type="submit" value="Save" class="submitButton">
    </form>
    <a href="index.php?page=fridge">
      <button class="backButton">Back</button>
    </a>
</article>
</div>