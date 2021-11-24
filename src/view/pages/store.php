<form class="storeform" action="index.php?page=store" method="post">
  <input type="hidden" name="action" value="store">
  <article class="formcontent">
    <h1 class="formtitle">store selection</h1>

    <div class="formStyle">
      <input type="radio" id="carrefour" name="favstore" value="carrefour">
      <label for="carrefour">Carrefour</label><br>
      <input type="radio" id="delhaize" name="favstore" value="delhaize">
      <label for="delhaize">Delhaize</label><br>
      <input type="radio" id="Albert Hein" name="favstore" value="Albert Hein" select="selected">
      <label for="Albert Hein">Albert Hein</label><br><br>
    </div>

    <input type="submit" value="favorite store" class="submitButton">
  </article> 
</form>
