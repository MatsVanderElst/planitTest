<div class="form__container">
  <form class="registerform jsForm" action="index.php?page=register" method="POST">
    <input type="hidden" name="action" value="register" />
    <article class="formcontent">
      <h1 class="formtitle">Register now</h1>

      <div class="formStyle">
        <label class="formlabel" for="nickname">Nickname</label>
        <input class="input" required name="nickname" type="text" placeholder="Emile">
        <span class="error"><?php if (!empty($errors['nickname'])) echo $errors['nickname']; ?></span>
      </div>

      <div class="formStyle">
        <label class="formlabel" for="email">E-mail</label>
        <input class="input" required name="email" type="email" placeholder="John.doe@gmail.com">
        <span class="error"><?php if (!empty($errors['email'])) echo $errors['email']; ?></span>
      </div>

      <div class="formStyle">
        <label class="formlabel" for="password">Password</label>
        <input class="input" required name="password" type="password" placeholder="***********">
        <span class="error"><?php if (!empty($errors['password'])) echo $errors['password']; ?></span>
      </div>

      <input type="submit" value="Register" class="submitButton">
    </article>
  </form>
</div>
