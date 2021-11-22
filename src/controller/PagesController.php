<?php

require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../model/User.php';


class PagesController extends Controller
{

  public function index()
  {
    // this should refer to a database query, a hard-coded object is used for demo purposes
    // $demos = Demo::all();

    //$demos = array(new Demo('first item'), new Demo('second item'), new Demo('last item'));
    // $this->set('demos',$demos);

  }
  public function login(){
    //logout wanneer je op login terechtkomt
    unset($_SESSION['user']);

    //adhv post form binnenhalen zie vorige forms
    if (!empty($_POST['action'])) {
      if ($_POST["action"] === "login") {
        //juiste user selecteren adhv email (want is uniek)
        $exists = User::where('email', '=', $_POST['email'])->get();
        //bestaat user?
        if (!empty($exists[0])) {
          // klopt het password?
          if ($exists[0]->password == $_POST['password']) {
            //gebruiker in session steken
            $_SESSION['user']['nickname'] = $exists[0]->name;


            $_SESSION['user']['email'] = $exists[0]->email;
            header('Location: index.php?page=personal');
          } else {
            //pw error
            $error = 'wrong password';
            $this->set('error', $error);
          }
        } else {
          //ingegeven email bestaat niet? -> register
          header('Location: index.php?page=register');
        }
      }
    }


  }

  public function register()
  {

    //uitloggen wanneer je hier terechtkomt
    unset($_SESSION['user']);

    if (!empty($_POST['action'])) {
      if (!empty($_POST['email'])) {
        //kijken of email al bestaat
        $exits = User::where('email', '=', $_POST['email'])->get();
        if (!empty($exits[0])) {
          $error['exists'] = "This e-mail is already in use.";
          header('Location: index.php?page=register');

          //exit wanneer email al bestaat
          exit();
        }
      }
      //is value van acrtion gelijk aan register?
      if ($_POST["action"] === "register") {
        //maakt nieuwe var aan voor user
        $user = new User([
          'nickname' => $_POST['nickname'],
          'email' => $_POST['email'],
          'password' => $_POST['password'],
        ]);
        //is input valid?
        $errors = User::validate($user);
        //geen errors? --> juiste user in session steken
        if (empty($errors)) {
          $_SESSION['user']['nickname'] = $user['nickname'];

          //in db steken
          $user->save();
          header('Location: index.php?page=personal');
          exit();
          //errors tonen als er zijn
        } else {
          $this->set('errors', $errors);
        }
      }
    }
  }
}
