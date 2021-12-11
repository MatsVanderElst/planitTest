<div>
  <h1 class="logintitle">
    <img src="./assets/images/title.svg" alt="mealplanner" class="titleImage">
  </h1>
  <div class="formContainer">
    <form class="creditformTwo jsForm" action="index.php?page=settings" method="post">
      <input type="hidden" name="action" value="credit">
      <article class="formcontent__credit">
        <div class="formStyle">
          <label class="formlabel" for="credit">Add money to your remaining budget</label>
          <input class="input" required name="credit" type="number" min="1" placeholder="100">
          <span class="error"><?php if (!empty($errors['credit'])) echo $errors['credit']; ?></span>
        </div>
      </article>
      <input type="submit" value="submit" class="submitButton">
    </form>

    <form class="creditformTwo" action="index.php?page=settings" method="post">
      <input type="hidden" name="action" value="store">
      <article class="formcontent__credit">
        <div class="formStyleTwo">
          <label class="formlabel" for="store">What's your favorite grocerystore?</label>
          <table class="stores">
            <tr>
              <td><input class="storeRadioButtonTwo" name="store" type="radio" value="carrefour" required></td>
              <td><label class="labelStyling" for="store">Carrefour</label></td>
            </tr>
            <tr>
              <td><input class="storeRadioButtonTwo" name="store" type="radio" value="delhaize"></td>
              <td><label class="labelStyling" for="store">Delhaize</label></td>
            </tr>
            <tr>
              <td><input class="storeRadioButtonTwo" name="store" type="radio" value="colruyt"></td>
              <td><label class="labelStyling" for="store">Colruyt</label></td>
            </tr>
            <tr>
              <td><input class="storeRadioButtonTwo" name="store" type="radio" value="alberthein"></td>
              <td><label class="labelStyling" for="store">Albert Hein</label></td>
            </tr>
            <tr>
              <td><input class="storeRadioButtonTwo" name="store" type="radio" value="aldi"></td>
              <td><label class="labelStyling" for="store">Aldi</label></td>
            </tr>
          </table>
        </div><br>
        <span class="error"><?php if (!empty($errors['store'])) echo $errors['store']; ?></span>
      </article>
      <input type="submit" value="Submit" class="submitButton">
    </form>
  </div>
</div>
