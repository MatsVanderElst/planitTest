<h1 class="logintitle">
  <img src="./assets/images/title.svg" alt="mealplanner" class="titleImage">
</h1>
<form class="creditform jsForm" action="index.php?page=credit" method="post">
  <input type="hidden" name="action" value="credit">
  <article class="formcontent__credit">
    <img src="./assets/images/hamburger.svg" alt="hamburger illustration" class="creditburger">


    <div class="formStyle">
      <label class="formlabel" for="credit">Weekly budget</label>
      <input class="input" required name="credit" type="number" min="1" placeholder="100">
      <span class="error"><?php if (!empty($errors['credit'])) echo $errors['credit']; ?></span>
    </div>


    <div>
      <p class="warning"> <span class="bold">Beware!</span> this budget is for groceries only. <br>
        If you want to have a fun night out you should <br>
        keep an amount on the side for drinking beers.</p>
    </div>
  </article>
  <input type="submit" value="submit" class="submitButton">
</form>
