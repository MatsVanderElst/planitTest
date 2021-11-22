<form class="loginform" action="index.php?page=login" method="post">
  <input type="hidden" name="action" value="login">
  <article class="formcontent">
    <h1 class="formtitle">Log in</h1>

    <div class="formStyle">
      <label class="formlabel" for="email"> E-mail</label>
      <input class="input" required name="email" type="email" placeholder="John.doe@gmail.com">
    </div>

    <div class="formStyle">
      <label class="formlabel" for="password">Password</label>
      <input class="input" type="text" name="password">
      <span class="error"><?php if (isset($error)) echo $error  ?></span>
    </div>
    <input type="submit" value="Login" class="submitButton">
  </article>
</form>
