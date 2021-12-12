<h1 class="logintitle">
  <img src="./assets/images/title.svg" alt="mealplanner" class="titleImage">
</h1>
<form class="registerform jsForm" action="index.php?page=register" method="POST">
  <input type="hidden" name="action" value="register" />
  <article class="formcontent__register">
    <img src="./assets/images/hamburger.svg" alt="hamburger illustration" class="registerburger">

    <div class="formStyle-first">
      <label class="formlabel" for="nickname">Nickname</label>
      <input class="input" required name="nickname" type="text" placeholder="Emile">
      <span class="error"><?php if (!empty($errors['nickname'])) echo $errors['nickname']; ?></span>
    </div>

    <div class="formStyle">
      <label class="formlabel" for="email">E-mail</label>
      <input class="input" required name="email" type="email" placeholder="John.doe@gmail.com">
      <span class="error"><?php if (!empty($_SESSION['error'])) echo $_SESSION['error']; ?></span>
    </div>

    <div class="formStyle">
      <label class="formlabel" for="password">Password</label>
      <input class="input" required name="password" type="password" placeholder="***********">
      <span class="error"><?php if (!empty($errors['password'])) echo $errors['password']; ?></span>
    </div>
  </article>
  <input type="submit" value="Register" class="submitButton">

  <article class="hasAcc">
    <p>Already have an account?</p>
    <a class="underline" href="index.php?page=login">Login</a>
  </article>
</form>
