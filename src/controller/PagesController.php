<?php

require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../model/User.php';
require_once __DIR__ . '/../model/Product.php';
require_once __DIR__ . '/../model/FridgeItem.php';
require_once __DIR__ . '/../model/DiscountProduct.php';


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
            $_SESSION['user']['id'] = $exists[0]->id;

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
          $_SESSION['error'] = $error['exists'];
          //print_r($_SESSION['error']);
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

          //in db steken
          $user = User::create([
            'nickname' => $_POST['nickname'],
            'email' => $_POST['email'],
            'password' => $_POST['password'],
            'credit' => 0,
            'favstore' => "none"
          ]);

          $_SESSION['user']['nickname'] = $user['nickname'];
          $_SESSION['user']['credit'] = $user['credit'];
          $_SESSION['user']['id'] = $user['id'];
          $_SESSION['user']['email'] = $user['email'];
          $_SESSION['user']['password'] = $user['password'];


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

    //anti hack --> niet ingelogd
    if (empty($_SESSION['user'])) {
      header('location:index.php?page=register');
    }

    unset($_SESSION['error']);

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

    //anti hack --> niet ingelogd
    if (empty($_SESSION['user'])) {
      header('location:index.php?page=register');
    }

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

    //anti hack --> niet ingelogd
    if (empty($_SESSION['user'])) {
      header('location:index.php?page=register');
    }

    $newCredit = $_SESSION['user']['credit'] - $_SESSION['total'];
    //zorgt er voor dat winkelmandje leeg wordt gemaakt na duwne op confirm zo kan gebruioker nieuwe lijst opstellen Ook wordt hier het budget vd user upgedate in de db
    if (!empty($_GET['action']) && $_GET['action'] == 'confirm') {
      $_SESSION['total'] = 0;

      $quantitiesById = array_count_values($_SESSION['list']);

      //groceries in DB steken
      foreach ($quantitiesById as $productId => $quantity) {
        $product = Product::find($productId);
        $fridgeItem = new FridgeItem;
        $fridgeItem->user_id = $_SESSION['user']['id'];
        $fridgeItem->product_id = $product['id'];
        $shelfLife = $product['shelf_life'];
        $expirationDate = Date('y:m:d', strtotime("+$shelfLife days"));
        $fridgeItem->quantity = $quantity;
        $fridgeItem->expiration_date = $expirationDate;
        $fridgeItem->save();
      }


      // haal fridgeitems uit DB en steek ze in de SESSIE
      /* $_SESSION['user']['fridge'] = FridgeItem::where('user_id',"=", $_SESSION['user']['id']); */


      $_SESSION['list'] = array();
      $user = User::where('email', '=', $_SESSION['user']['email'])->update(['credit' => $newCredit]);
      $_SESSION['user']['credit'] = $newCredit;
    }
  }

  public function list()
  {

    //anti hack --> niet ingelogd
    if (empty($_SESSION['user'])) {
      header('location:index.php?page=register');
    }


    $_SESSION['overschot'] = $_SESSION['user']['credit'];


    //producten uit db halen
    $allProducts = Product::all();
    //zoekfunctie
    if (!empty($_GET['product'])) {
      $products = Product::where('product', 'LIKE', '%' . $_GET['product'] . '%');
    } else {
      $products = Product::query();
    }


    $itemsPerPage = 12;
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
      echo ($jsonProducts);
      exit();
    }

    $this->set('products', $products);
    $this->set('totalPages', $totalPages);
    $this->set('currentPage', $currentPage);


    if (!empty($_GET['addProduct'])) {
      $addedProduct = Product::where('id', '=', $_GET['addProduct'])->get();
      //print_r($selectedProduct);


      //prijs aanpassen adhv gekozen winkel
      if ($_SESSION['user']['favstore'] == 'delhaize') {
        $_SESSION['total'] = $_SESSION['total'] + $addedProduct[0]['price'] + 0.4;
      } elseif ($_SESSION['user']['favstore'] == 'carrefour') {
        $_SESSION['total'] = $_SESSION['total'] + $addedProduct[0]['price'] - 0.2;
      } elseif ($_SESSION['user']['favstore'] == 'colruyt') {
        $_SESSION['total'] = $_SESSION['total'] + $addedProduct[0]['price'] - 0.5;
      } elseif ($_SESSION['user']['favstore'] == 'alberthein') {
        $_SESSION['total'] = $_SESSION['total'] + $addedProduct[0]['price'] - 0.3;
      } else {
        $_SESSION['total'] = $_SESSION['total'] + $addedProduct[0]['price'];
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

    if (!empty($_GET['addProduct'])) {
      if ($_SESSION['total'] <= $_SESSION['user']['credit']) {
        array_push($_SESSION['list'], $_GET['addProduct']);
        //print_r($_SESSION['list']);
      }
    }
  }

  public function cart()
  {

    //anti hack --> niet ingelogd
    if (empty($_SESSION['user'])) {
      header('location:index.php?page=register');
    }
    //print_r($_SESSION['list']);

    $selectedProducts = array();

    foreach ($_SESSION['list'] as $productId) {
      $selectedProduct = Product::find($productId);
      array_push($selectedProducts, $selectedProduct);
    }


    //zet de totale prijs op 0 wanneer geen producten meer in de mand zitten
    $_SESSION['total'] = 0;


    //wanneer er op het vuilbakje wordt gedrukt
    if (!empty($_GET['action'])) {

      if ($_GET['action'] == 'delete') {
        //zet string nummer om naar een echt nummer
        $deleteProductId = intval($_GET['deleteProduct']);

        $index = 0;


        foreach ($selectedProducts as $product) {
          if ($product['id'] == $deleteProductId) {
            unset($selectedProducts[$index]);
            unset($_SESSION['list'][$index]);
            break;
          }
          $index = $index + 1;
        }
      }
    }

    //zet de totale prijs op de som van alle producten die nog in het winkelmandje zitten
    if (!empty($selectedProducts)) {
      foreach ($selectedProducts as $product) {
        if ($_SESSION['user']['favstore'] == 'delhaize') {
          $_SESSION['total'] += $product['price'] + 0.4;
        } elseif ($_SESSION['user']['favstore'] == 'carrefour') {
          $_SESSION['total'] += $product['price'] - 0.2;
        } elseif ($_SESSION['user']['favstore'] == 'colruyt') {
          $_SESSION['total'] += $product['price'] - 0.5;
        } elseif ($_SESSION['user']['favstore'] == 'alberthein') {
          $_SESSION['total'] += $product['price'] - 0.3;
        } else {
          $_SESSION['total'] += $product['price'];
        }
      }
    }

    /* $_SESSION['list'] = $selectedProducts; */

    $this->set('selectedProducts', $selectedProducts);
  }

  public function fridge()
  {
    //anti hack --> niet ingelogd
    if (empty($_SESSION['user'])) {
      header('location:index.php?page=register');
    }

    if (!empty($_GET['action'])) {
      if ($_GET['action'] == "use"){
        //find item with correct id
        $fridgeItem=FridgeItem::find($_GET['productId']);
        if($fridgeItem['quantity'] === 1){
          // delete te record from the db
          $fridgeItem->delete();
        }else{
          $fridgeItem['quantity'] = $fridgeItem['quantity'] - 1;
          $fridgeItem->save();
        }

      }

    }

    $items = FridgeItem::where("user_id", "=", $_SESSION['user']['id'])->get();
    $this->set("fridgeItemCount", $items->count());
    $this->set('fridge', $items);

  }

  public function settings()
  {

    //anti hack --> niet ingelogd
    if (empty($_SESSION['user'])) {
      header('location:index.php?page=register');
    }
    $user = User::where('email', '=', $_SESSION['user']['email'])->first(); //->update(['credit' => $credits]);
    if ($_SESSION) {
      // check if form was submitted
      if (!empty($_POST['action'])) {

        // which form whas submitted?
        if ($_POST['action'] === 'credit') {
          $credits = $_POST['credit'];

          //validate the input
          $errors = User::validate($user);
          if (empty($errors)) {

            //update the user
            //$user->update(['credit' => $credits]);
            $user->increment('credit', $credits);
            // update session
            $_SESSION['user']['credit'] = $user['credit'];
            header('Location:index.php?page=settings');
            exit();
          } else {
            $this->set('errors', $errors);
          }
        } else if ($_POST['action'] === 'store') {
          $store = $_POST['store'];
          //$user = User::where('email', '=', $_SESSION['user']['email'])->first();
          //validate the user we retrieved from session
          $errors = User::validate($user);
          if (empty($errors)) {
            //update the user
            $user->update(['favstore' => $store]);
            // update session
            $_SESSION['user']['favstore'] = $user['favstore'];
            header('Location:index.php?page=settings');
            exit();
          } else {
            $this->set('errors', $errors);
          }
        }
      }
      $this->set('user', $user);
    } else {
      header('Location:index.php');
      exit();
    }
  }

  public function productDetail()
  {

    //anti hack --> niet ingelogd
    if (empty($_SESSION['user'])) {
      header('location:index.php?page=register');
    }
    $product = Product::find($_GET['detailedProduct']);
    $this->set("product", $product);

  }
  public function editDate()
  {
    $datedProduct = FridgeItem::find($_GET['fridgeItemId']);
    $this->set("fridgeItem", $datedProduct);

    if (!empty($_GET['action'])) {
      if ($_GET['action'] == "editDate"){
        $datedProduct['expiration_date'] = date("Y-m-d", strtotime($_GET['newDate']));
        $datedProduct->save();
      }
    }
  }

  public function discountProduct() {

    //anti hack --> niet ingelogd
    if (empty($_SESSION['user'])) {
      header('location:index.php?page=register');
    }


    $_SESSION['overschot'] = $_SESSION['user']['credit'];


    //producten uit db halen
    $discProducts = DiscountProduct::all();




    $this->set('discProducts', $discProducts);

    if (!empty($_GET['addProduct'])) {
      $addedProduct = DiscountProduct::where('id', '=', $_GET['addProduct'])->get();
      //print_r($selectedProduct);


      //prijs aanpassen adhv gekozen winkel
      if ($_SESSION['user']['favstore'] == 'delhaize') {
        $_SESSION['total'] = $_SESSION['total'] + $addedProduct[0]['price'] + 0.4;
      } elseif ($_SESSION['user']['favstore'] == 'carrefour') {
        $_SESSION['total'] = $_SESSION['total'] + $addedProduct[0]['price'] - 0.2;
      } elseif ($_SESSION['user']['favstore'] == 'colruyt') {
        $_SESSION['total'] = $_SESSION['total'] + $addedProduct[0]['price'] - 0.5;
      } elseif ($_SESSION['user']['favstore'] == 'alberthein') {
        $_SESSION['total'] = $_SESSION['total'] + $addedProduct[0]['price'] - 0.3;
      } else {
        $_SESSION['total'] = $_SESSION['total'] + $addedProduct[0]['price'];
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

    if (!empty($_GET['addProduct'])) {
      if ($_SESSION['total'] <= $_SESSION['user']['credit']) {
        array_push($_SESSION['list'], $_GET['addProduct']);
        //print_r($_SESSION['list']);
      }
    }

  }


}

