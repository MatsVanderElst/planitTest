<form class="registerform" action="index.php?page=register" method="POST">
  <input type="hidden" name="action" value="register" />
  <article class="formcontent">
    <h1>Register now</h1>

    <div>
      <label class="formlabel" for="nickname">Nickname</label>
      <input required name="nickname" type="text" placeholder="Emile">
    </div>

    <div>
      <label class="formlabel" for="email">E-mail</label>
      <input required name="email" type="email" placeholder="John.doe@gmail.com" >
    </div>

    <div>
      <label class="formlabel" for="password">Password</label>
      <input required name="password" type="text" placeholder="***********">
    </div>
  </article>
</form>
