<h1 class="logintitle">
  <img src="./assets/images/title.svg" alt="mealplanner" class="titleImage">
</h1>
<form class="creditform jsForm" action="index.php?page=credit" method="post">
  <input type="hidden" name="action" value="credit">
  <article class="formcontent__credit">
    <img src="./assets/images/hamburger.svg" alt="hamburger illustration" class="creditburger">
 
      <p class="fridgeSubTitle"> <?php echo $_SESSION['user']['nickname'] ?>, There are <?php echo $_SESSION['user']['fridgeItemCount'] ?>, item’s in your fridgee </p>
    <p class="fridgeParagraph">Here’s an overview of the products you Have at home. Tap the product to see it’s details.</p>
    <ul>
        <li class="fridgeItem">
            <a>
                <p>Banana</p>
            </a>
        </li>
        <li class="fridgeItem">
            <a>
                <p>Banana</p>
            </a>
        </li>
        <li class="fridgeItem">
            <a>
                <p>Banana</p>
            </a>
        </li>
        <li class="fridgeItem">
            <a>
                <p>Banana</p>
            </a>
        </li>
        <li class="fridgeItem">
            <a>
                <p>Banana</p>
            </a>
        </li>
        <li class="fridgeItem">
            <a>
                <p>Banana</p>
            </a>
        </li>
    </ul>


  </article>
  <input type="submit" value="submit" class="submitButton">
</form>
