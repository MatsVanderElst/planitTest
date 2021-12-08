<div>
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
    </article>
    <input type="submit" value="submit" class="submitButton">
  </form>

  <form class="storeform" action="index.php?page=store" method="post">
    <input type="hidden" name="action" value="store">
    <article class="storeformcontent">
      <p class="storeParagraph">What is your favorite grocery store chain?</p>
      <div class="storeStyle">
        <table>
          <tr>
            <td><input class="storeRadioButton" name="store" type="radio" value="carrefour"></td>
            <td class="lbl"><label class="labelStyling" for="store">Carrefour</label></td>
          </tr>
          <tr>
            <td><input class="storeRadioButton" name="store" type="radio" value="delhaize"></td>
            <td class="lbl"><label class="labelStyling" for="store">Delhaize</label></td>
          </tr>
          <tr>
            <td><input class="storeRadioButton" name="store" type="radio" value="colruyt"></td>
            <td class="lbl"><label class="labelStyling" for="store">Colruyt</label></td>
          </tr>
          <tr>
            <td><input class="storeRadioButton" name="store" type="radio" value="alberthein"></td>
            <td class="lbl"><label class="labelStyling" for="store">Albert Hein</label></td>
          </tr>
          <tr>
            <td><input class="storeRadioButton" name="store" type="radio" value="aldi"></td>
            <td class="lbl"><label class="labelStyling" for="store">Aldi</label></td>
          </tr>
        </table>
      </div><br>
      <input type="submit" value="Submit" class="storeSubmitButton">
      <span class="error"><?php if (!empty($errors['store'])) echo $errors['store']; ?></span>
    </article>
  </form>
</div>
