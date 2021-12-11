<div>
  <h1 class="logintitle">
    <img src="./assets/images/title.svg" alt="mealplanner" class="titleImage">
  </h1>
  <div class="formContainer">
    <form class="creditformTwo jsForm" action="index.php?page=settings" method="post">
      <input type="hidden" name="action" value="credit">
      <article class="formcontent__credit">
        <div class="formStyleTwo">
          <label class="formlabel" for="credit">Add money to your remaining budget</label>
          <input class="input" required name="credit" type="number" min="1" placeholder="100">
          <input type="submit" value="submit" class="submitButton extraMarginTop">
          <span class="error"><?php if (!empty($errors['credit'])) echo $errors['credit']; ?></span>
        </div>
      </article>

    </form>

    <form class="creditformTwo" action="index.php?page=settings" method="post">
      <input type="hidden" name="action" value="store">
      <article class="formcontent__credit">
        <div class="formStyleTwo">
          <label class="formlabel extraMargin" for="store">What's your favorite grocerystore?</label>
          <div class="stores">
            <article class="choices">
              <input class="storeRadioButtonTwo" name="store" type="radio" value="carrefour" required>
              <label class="labelStyling" for="store">Carrefour</label>
            </article>
            <article class="choices">
              <input class="storeRadioButtonTwo" name="store" type="radio" value="delhaize">
              <label class="labelStyling" for="store">Delhaize</label>
            </article>
            <article class="choices">
              <input class="storeRadioButtonTwo" name="store" type="radio" value="colruyt">
              <label class="labelStyling" for="store">Colruyt</label>
            </article>
            <article class="choices">
              <input class="storeRadioButtonTwo" name="store" type="radio" value="alberthein">
              <label class="labelStyling" for="store">Albert Hein</label>
            </article>
            <article class="choices">
              <input class="storeRadioButtonTwo" name="store" type="radio" value="aldi">
              <label class="labelStyling" for="store">Aldi</label>
            </article>
          </div>
          <input type="submit" value="Submit" class="submitButton extraMarginTop">
          <span class="error"><?php if (!empty($errors['store'])) echo $errors['store']; ?></span>
        </div>
      </article>

    </form>
  </div>
</div>
