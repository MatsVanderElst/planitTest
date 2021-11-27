<h1 class="logintitle">
  <img src="./assets/images/title.svg" alt="mealplanner" class="titleImage">
</h1>
<form class="loginform jsForm" action="index.php?page=login" method="post">
  <input type="hidden" name="action" value="login">

  <article class="formcontent">

    <img src="./assets/images/hamburger.svg" alt="hamburger illustration" class="loginBruger">

    <div class="formStyle">
      <label class="formlabel" for="email"> E-mail</label>
      <input class="input" required name="email" type="email" placeholder="John.doe@gmail.com">
      <span class="error"><?php if (!empty($errors['email'])) echo $errors['email']; ?></span>
    </div>

    <div class="formStyle">
      <label class="formlabel" for="password">Password</label>
      <input class="input" required name="password" type="password" placeholder="***********">
      <span class="error"><?php if (!empty($errors['password'])) echo $errors['password']; ?></span>
    </div>


  </article>
  <input type="submit" value="Login" class="submitButton">
</form>
