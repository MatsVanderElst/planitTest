<form class="storeform" action="index.php?page=store" method="post">
  <input type="hidden" name="action" value="store">
  <article class="storeformcontent">
    <h1 class="storetitle">
      <img src="assets/images/title.svg" alt="mealplanner" class="titleImage">
    </h1>
    <h2 class="storeWelcomeMessage">Welcome Student<?php ?></h2>
    <p class="storeParagraph">What is your favorite grocery store chain?</p>

    <input type="input" class="storeInput" name="favstore" value=""><br>

    <!-- <div class="storeStyle">
      <input type="radio" class="storeRadioButton" name="favstore" value="carrefour">
      <label for="carrefour">Carrefour</label><br>
      <input type="radio" class="store2" name="favstore" value="delhaize">
      <label for="delhaize">Delhaize</label><br>
      <input type="radio" class="store1" name="favstore" value="Albert Hein" select="selected">
      <label for="Albert Hein">Albert Hein</label><br>
      <input type="radio" id="Albert Hein" name="favstore" value="Albert Hein" select="selected">
      <label for="Albert Hein">Jumbo</label><br>
    </div> -->

    <div class="storeStyle">
      <table>
          <tr>
            <td><input class="storeRadioButton" id="name" type="radio"></td>
            <td class="lbl"><label class="labelStyling" for="store">Carrefour</label></td>
          </tr>
          <tr>
            <td><input class="storeRadioButton" id="name" type="radio"></td>
            <td class="lbl"><label class="labelStyling" for="store">Delhaize</label></td>
          </tr>
          <tr>
            <td><input class="storeRadioButton" id="name" type="radio"></td>
            <td class="lbl"><label class="labelStyling" for="store">Colruyt</label></td>
          </tr>
          <tr>
            <td><input class="storeRadioButton" id="name" type="radio"></td>
            <td class="lbl"><label class="labelStyling" for="store">Albert Hein</label></td>
          </tr>
          <tr>
            <td><input class="storeRadioButton" id="name" type="radio"></td>
            <td class="lbl"><label class="labelStyling" for="store">Aldi</label></td>
          </tr>
      </table>
    </div><br>        
    <input type="submit" value="Submit" class="storeSubmitButton" >
  </article>
</form>
