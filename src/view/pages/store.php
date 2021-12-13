<form class="storeform" action="index.php?page=store" method="post">
  <input type="hidden" name="action" value="store">
  <article class="storeformcontent">
    <h1 class="storetitle">
      <img src="assets/images/title.svg" alt="mealplanner" class="storeTitleImage">
    </h1>
    <h2 class="storeWelcomeMessage">Welcome <?php echo $_SESSION['user']['nickname']?><?php ?></h2>
    <p class="storeParagraph">What is your favorite grocery store chain?</p>
    <div class="storeStyle">
          <div class="storeItem">
            <td><input class="storeRadioButton" name="store" type="radio" value="carrefour"></td>
            <td class="lbl"><label class="labelStyling" for="store">Carrefour</label></td>
          </div>
          <div class="storeItem">
            <td><input class="storeRadioButton" name="store" type="radio" value="delhaize"></td>
            <td class="lbl"><label class="labelStyling" for="store">Delhaize</label></td>
          </div>
            <div class="storeItem">
            <td><input class="storeRadioButton" name="store" type="radio" value="colruyt"></td>
            <td class="lbl"><label class="labelStyling" for="store">Colruyt</label></td>
          </div>  
          <div class="storeItem">
            <td><input class="storeRadioButton" name="store" type="radio" value="alberthein"></td>
            <td class="lbl"><label class="labelStyling" for="store">Albert Hein</label></td>
          </div>
          <div class="storeItem">  
            <td><input class="storeRadioButton" name="store" type="radio" value="aldi"></td>
            <td class="lbl"><label class="labelStyling" for="store">Aldi</label></td>  
          </div>
    </div><br>        
    <input type="submit" value="Submit" class="storeSubmitButton" >
    <span class="error"><?php if (!empty($errors['store'])) echo $errors['store']; ?></span>
  </article>
</form>
