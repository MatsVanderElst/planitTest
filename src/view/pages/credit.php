<form class="creditform" action="index.php?page=credit" method="post">
  <input type="hidden" name="action" value="credit">
  <article class="formcontent">
    <h1 class="formtitle">what is your weekly budget for food?</h1>

    <div class="formStyle">
      <label class="formlabel" for="credit">Budget</label>
      <input class="input" required name="credit" type="number" placeholder="100">
    </div>

    <div>
      <p>Beware this budget is for groceries only. <br>
        If you want to have a fun night out you should <br>
        keep an amount on the side for drinking beers.</p>
    </div>


    <input type="submit" value="submit" class="submitButton">
  </article>
</form>
