<form class="storeform" action="index.php?page=store" method="post">
  <input type="hidden" name="action" value="store">
  <article class="storeformcontent">
    <h1 class="storetitle">
      <img src="assets/images/title.svg" alt="mealplanner" class="titleImage">
    </h1>
    <h2>welcome <?php ?></h2>
    <p class="storeParagraph">What is your favorite grocery store chain?</p>
    <div class="storeStyle">
      <input type="input" class="storeinput" name="favstore" value="favorite store"><br>
      <input type="radio" class="store1" name="favstore" value="carrefour">
      <label for="carrefour">Carrefour</label><br>
      <input type="radio" class="store2" name="favstore" value="delhaize">
      <label for="delhaize">Delhaize</label><br>
      <input type="radio" class="store1" name="favstore" value="Albert Hein" select="selected">
      <label for="Albert Hein">Albert Hein</label><br>
      <input type="radio" id="Albert Hein" name="favstore" value="Albert Hein" select="selected">
      <label for="Albert Hein">Jumbo</label><br>
    </div>

    <input type="submit" value="favorite store" class="submitButton">
  </article>
</form>
