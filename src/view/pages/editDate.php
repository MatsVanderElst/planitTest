<div class="editDateContainer">
  <h1 class="logintitle">
    <img src="./assets/images/title.svg" alt="mealplanner" class="titleImage editDate">
  </h1>
  <div class="editDateHeader__container">
    <p>Edit the expiration date of this <?php echo $fridgeItem->product['product'] ?>.</p>
    <p class="break">The current expiration date is displayed below</p>
  </div>
  <article class="formcontent__editDate">
    <form class="editDate_form" method="get" action="index.php?">
      <input name="action" type="hidden" value="editDate">
      <input name="page" type="hidden" value="editDate">
      <input name="fridgeItemId" type="hidden" value="<?php echo $fridgeItem['id'] ?>">
      <input class="newDate" name="newDate" type="date" value="<?php echo $fridgeItem['expiration_date'] ?>">
      <input type="submit" value="Save" class="submitButton">
    </form>
  </article>
  <a href="index.php?page=fridge">
    <button class="backButton">Back</button>
  </a>
</div>
