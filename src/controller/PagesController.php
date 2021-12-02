<?php

require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../model/User.php';
require_once __DIR__ . '/../model/Product.php';



class PagesController extends Controller
{

  public function index()
  {
    // this should refer to a database query, a hard-coded object is used for demo purposes
    // $demos = Demo::all();

    //$demos = array(new Demo('first item'), new Demo('second item'), new Demo('last item'));
    // $this->set('demos',$demos);

  }

  public function login()
  {
    //logout wanneer je op login terechtkomt
    unset($_SESSION['user']);

    $_SESSION['total'] = 0;
    $_SESSION['cart'] = array();

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
            $_SESSION['user']['nickname'] = $exists[0]->nickname;
            $_SESSION['user']['credit'] = $exists[0]->credit;
            $_SESSION['user']['email'] = $exists[0]->email;
            header('Location: index.php?page=menu');
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

    $_SESSION['total'] = 0;
    $_SESSION['cart'] = array();

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
      //is value van action gelijk aan register?
      if ($_POST["action"] === "register") {
        //maakt nieuwe var aan voor user
        $user = new User([
          'nickname' => $_POST['nickname'],
          'email' => $_POST['email'],
          'password' => $_POST['password'],
          'credit' => 0,
          'favstore' => "none"
        ]);
        //is input valid?
        $errors = User::validate($user);
        //geen errors? --> juiste user in session steken
        if (empty($errors)) {
          $_SESSION['user']['nickname'] = $user['nickname'];
          $_SESSION['user']['credit'] = $user['credit'];
          $_SESSION['user']['id'] = $user['id'];
          $_SESSION['user']['email'] = $user['email'];
          $_SESSION['user']['password'] = $user['password'];

          //in db steken
          $user->save();
          header('Location: index.php?page=credit');
          exit();
          //errors tonen als er zijn
        } else {
          $this->set('errors', $errors);
        }
      }
    }
  }

  public function credit()
  {

    if ($_SESSION) {
      // check if form was submitted
      if (!empty($_POST['action'])) {
        // which form whas submitted?
        if ($_POST['action'] === 'credit') {
          $credits = $_POST['credit'];
          $user = User::where('email', '=', $_SESSION['user']['email'])->first(); //->update(['credit' => $credits]);
          //validate the input
          $errors = User::validate($user);
          if (empty($errors)) {

            //update the user
            $user->update(['credit' => $credits]);
            // update session
            $_SESSION['user']['credit'] = $user['credit'];
            header('Location:index.php?page=store');
            exit();
          } else {
            $this->set('errors', $errors);
          }
        }
        $this->set('user', $user);
      }
    } else {
      header('Location:index.php');
      exit();
    }
  }

  public function store()
  {

    if ($_SESSION) {
      // check if form was submitted
      if (!empty($_POST['action'])) {
        // which form whas submitted?
        if ($_POST['action'] === 'store') {
          $store = $_POST['store'];
          $user = User::where('email', '=', $_SESSION['user']['email'])->first();
          //validate the user we retrieved from session
          $errors = User::validate($user);
          if (empty($errors)) {
            //update the user
            $user->update(['favstore' => $store]);
            header('Location:index.php?page=menu');
            exit();
          } else {
            $this->set('errors', $errors);
          }
        }
        $this->set('user', $user);
      }
    } else {
      header('Location:index.php');
      exit();
    }
  }

  public function menu()
  {
  }

  public function list()
  {


    //producten uit db halen
    $products = Product::all();

    //zoekfunctie
    if (!empty($_GET['product'])) {
      $products = Product::where('product', 'LIKE', '%' . $_GET['product'] . '%')->get();
    }
    //naar html 'sturen' voor echo
    $this->set('products', $products);



    if (!empty($_GET['product_product'])) {
      $selectedProduct = Product::where('product', '=', $_GET['product_product'])->get();
      //print_r($selectedProduct);

      $_SESSION['total'] = $_SESSION['total'] + $selectedProduct[0]['price'];

      //print_r($_SESSION['total']);

      if ($_SESSION['total'] > $_SESSION['user']['credit']) {
        header('Location: index.php?page=cart');
        //print_r("teveel");
        //print_r($_SESSION['list']);
      }

      //$_SESSION['user']['credit'] = ($_SESSION['user']['credit'] - $_SESSION['total']);
      $_SESSION['overschot'] = ($_SESSION['user']['credit'] - $_SESSION['total']);
      //print_r($_SESSION['overschot']);

    }

    if (!empty($_GET['product_product'])) {
      if ($_SESSION['total'] <= $_SESSION['user']['credit']) {
        array_push($_SESSION['list'], $_GET['product_product']);
        print_r($_SESSION['list']);
      }
    }
  }

  public function cart()
  {
    //print_r($_SESSION['list']);

    $selectedProducts = array();

    foreach ($_SESSION['list'] as $productName) {
      $selectedProducts[] = Product::where('product', '=', $productName)->get();
    }

    //zet de totale prijs op 0 wanneer geen producten meer in de mand zitten
    $_SESSION['total'] = 0;


    //wanneer er op het vuilbakje wordt gedrukt
    if (!empty($_GET['action'])) {

      if ($_GET['action'] == 'delete') {
        //zet string nummer om naar een echt nummer
        $StringNumber = intval($_GET['product_product']);

        /*verwijder het element met de juiste index selectedproducts is een array en bv. het eerste element heeft index
                0 deze index geef je mee aan de url (product=0) aan de hand van de url verwijder je dan dat element */

        unset($selectedProducts[$StringNumber]);

        //zoek de index van het verwijderde product (volgens naam) in de session om die later te gaan verwijderen
        $listIndex = array_search($productName, $_SESSION['list']);

        unset($_SESSION['list'][$listIndex]);
      }
    }

    //zet de totale prijs op de som van alle producten die nog in het winkelmandje zitten
    if (!empty($selectedProducts)) {
      foreach ($selectedProducts as $product) {
        $_SESSION['total'] += $product[0]['price'];
      }
    }

    $this->set(
      'selectedProducts',
      $selectedProducts
    );
  }
}





