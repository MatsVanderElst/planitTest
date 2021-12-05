<?php

require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../model/User.php';
require_once __DIR__ . '/../model/Product.php';

class PagesController extends Controller
{

  public function index()
  {
  }

  public function login()
  {
    //logout wanneer je op login terechtkomt
    unset($_SESSION['user']);

    $_SESSION['total'] = 0;
    $_SESSION['list'] = array();


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
            $_SESSION['user']['favstore'] = $exists[0]->favstore;
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
    $_SESSION['list'] = array();

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
            // update session
            $_SESSION['user']['favstore'] = $user['favstore'];
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
    $newCredit = $_SESSION['user']['credit'] - $_SESSION['total'];
    //zorgt er voor dat winkelmandje leeg wordt gemaakt na duwne op confirm zo kan gebruioker nieuwe lijst opstellen Ook wordt hier het budget vd user upgedate in de db
    if (!empty($_GET['confirm'])) {
      $_SESSION['total'] = 0;
      $_SESSION['list'] = array();
      $user = User::where('email', '=', $_SESSION['user']['email'])->update(['credit' => $newCredit]);
      $_SESSION['user']['credit'] = $newCredit;
    }
  }

  public function list()
  {


    $_SESSION['overschot'] = $_SESSION['user']['credit'];


    //producten uit db halen
    $allProducts = Product::all();
    //zoekfunctie
    if (!empty($_GET['product'])) {
      $products = Product::where('product', 'LIKE', '%' . $_GET['product'] . '%');
    }else{
      $products = Product::query();
    }
    
    
    $itemsPerPage = 25;
    $totalPages = ceil($allProducts->count() / $itemsPerPage);
    $currentPage = 1;
    if (isset($_GET['p']) && $_GET['p'] > 0 && $_GET['p'] <= $totalPages) {
      $currentPage = $_GET['p'];
    }
    $offset = ($currentPage - 1) * $itemsPerPage;
    
    $products = $products->offset($offset)->limit($itemsPerPage)->get();
    
    // Check if we need to respond with json
    if (!empty($_GET['json'])) {
      $jsonProducts = $products->toJson();
      echo($jsonProducts);
      exit(); 
    }

    $this->set('products', $products);
    $this->set('totalPages', $totalPages);
    $this->set('currentPage', $currentPage);
    

    if (!empty($_GET['product_product'])) {
      $selectedProduct = Product::where('product', '=', $_GET['product_product'])->get();
      //print_r($selectedProduct);


      //prijs aanpassen adhv gekozen winkel
      if ($_SESSION['user']['favstore'] == 'delhaize') {
        $_SESSION['total'] = $_SESSION['total'] + $selectedProduct[0]['price'] + 0.4;
      } elseif ($_SESSION['user']['favstore'] == 'carrefour') {
        $_SESSION['total'] = $_SESSION['total'] + $selectedProduct[0]['price'] - 0.2;
      } elseif ($_SESSION['user']['favstore'] == 'colruyt') {
        $_SESSION['total'] = $_SESSION['total'] + $selectedProduct[0]['price'] - 0.5;
      } elseif ($_SESSION['user']['favstore'] == 'alberthein') {
        $_SESSION['total'] = $_SESSION['total'] + $selectedProduct[0]['price'] - 0.3;
      } else {
        $_SESSION['total'] = $_SESSION['total'] + $selectedProduct[0]['price'];
      }


      //print_r($_SESSION['total']);

      if ($_SESSION['total'] > $_SESSION['user']['credit']) {
        header('Location: index.php?page=cart');
        //print_r("teveel");
        //print_r($_SESSION['list']);
      }

      /*if ($_SESSION['total'] = 0) {
        $_SESSION['overschot'] = ($_SESSION['user']['credit']);
      } else {
        $_SESSION['overschot'] = ($_SESSION['user']['credit'] - $_SESSION['total']);
      }*/

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
        if ($_SESSION['user']['favstore'] == 'delhaize') {
          $_SESSION['total'] += $product[0]['price'] + 0.4;
        } elseif ($_SESSION['user']['favstore'] == 'carrefour') {
          $_SESSION['total'] += $product[0]['price'] - 0.2;
        } elseif ($_SESSION['user']['favstore'] == 'colruyt') {
          $_SESSION['total'] += $product[0]['price'] - 0.5;
        } elseif ($_SESSION['user']['favstore'] == 'alberthein') {
          $_SESSION['total'] += $product[0]['price'] - 0.3;
        } else {
          $_SESSION['total'] += $product[0]['price'];
        }
      }
    }



    $this->set('selectedProducts', $selectedProducts);
  }
}





