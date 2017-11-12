<?php

    date_default_timezone_set('America/Los_Angeles');
    require_once __DIR__."/../vendor/autoload.php";

    //Class constructors
    require_once __DIR__."/../src/Player.php";

    session_start();
    if (empty($_SESSION['order_of_init'])) {
        $_SESSION['order_of_init'] = array();
    }

    $app = new Silex\Application();

    //MySQL database info changing to seetings.php outside of the docroot
    require_once __DIR__."/../../settings.php";

    $server = 'mysql:host=' .
        $settings['host'] . ':' .
        $settings['port'] . ';dbname=' .
        $settings['namedb'];
    $username = $settings['username'];
    $password = $settings['password'];

    $DB = new PDO($server, $username, $password);

    //$app['debug'] = true;

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    // GETS

    // Go to homepage
    $app->get("/", function() use ($app) {
      $message = '{{message}}';
        return $app['twig']->render('index.html.twig', array('players' => Player::getAllPCs(), 'message' => $message));
    });

    $app->get("/init", function() use ($app) {
        //$users = User::getAll();
        // $_SESSION['order_of_init'] = array();
        if (empty($_SESSION['order_of_init'])) {
          $_SESSION['order_of_init'] = Player::orderByInit([0,0,0,0]);
        }

        // $order = $_SESSION['order_of_init'];

        return $app['twig']->render('init.html.twig', array('players' => Player::getAllPCs(), 'enemies' => Player::getAllEnemies(), 'order' => $_SESSION['order_of_init']));
    });

    $app->get("/enemies", function() use ($app) {
        //$users = User::getAll();
        return $app['twig']->render('enemies.html.twig', array('enemies' => Player::getAllEnemies()));
    });

    $app->get("/add_npcs", function() use ($app) {
        //$users = User::getAll();
        return $app['twig']->render('addNpcs.html.twig', array('enemies' => Player::getAllEnemies()));
    });

    $app->get("/character/{name}", function($name) use ($app) {
        $character = Player::findByName($name);
        return $app['twig']->render('character.html.twig', array('player' => $character));
    });

    $app->get("/redirect", function() use ($app) {
        $order = $_SESSION['order_of_init'];
        $turn_end = array_shift($order);
        array_push($order, $turn_end);
        $_SESSION['order_of_init'] = $order;
        return $app['twig']->render('redirect.html.twig');
    });

    // POSTS

    // From the HP edit page. This need to be changed as posting to the Homepage is not a great idea.
    $app->post("/", function() use ($app) {
        $id = intval($_POST['id']);
        $updatedHp = intval($_POST['hp']);
        $character = Player::findById($id);
        $oldHp =$character->getHp();
        if($oldHp != $updatedHp)
        {
            $character->updateHp($updatedHp, $oldHp);
        }
        return $app['twig']->render('index.html.twig', array('players' => Player::getAllPCs()));
    });

    //Setting up '/add_enemy' coming from the homepage
    $app->post("/add_npcs", function() use ($app) {
        $rolls_array = [
            "Bindi" => intval($_POST['init_Bindi']),
            "LL" => intval($_POST['init_LL']),
            "Karrik" => intval($_POST['init_Karrik']),
            "Tonka" => intval($_POST['init_Tonka']),
        ];

        $_SESSION['order_of_init'] = Player::orderWithPCName($rolls_array);

        return $app['twig']->render('addNpcs.html.twig', array('enemies' => Player::getAllEnemies(), 'order' => $_SESSION['order_of_init']));
    });

    //Coming from the add_enemy page
    $app->post("/another_npc", function() use ($app) {

        $name = $_POST['name'];
        $hp = intval($_POST['hp']);
        $init = intval($_POST['init']);
        $ac = intval($_POST['ac']);
        $summary = "";
        $test_player3 = new Player($name, $hp, $ac, $init, $summary, $enemy = 1);
        $test_player3->save();

        $_SESSION['order_of_init'] = Player::addEnemyToOrder($_SESSION['order_of_init'],  $test_player3);

        return $app['twig']->render('addNpcs.html.twig', array('enemies' => Player::getAllEnemies(), 'order' => $_SESSION['order_of_init']));
    });

    //Coming from /another_enemy page to the init page
    $app->post("/init", function() use ($app) {
        $name = $_POST['enemy_name'];
        $hp = intval($_POST['enemy_hp']);
        $init = intval($_POST['enemy_init']);
        $ac = intval($_POST['enemy_ac']);
        $summary = "";
        $test_player3 = new Player($name, $hp, $ac, $init, $summary, $enemy = 1);
        $test_player3->save();

        $_SESSION['order_of_init'] = Player::addEnemyToOrder($_SESSION['order_of_init'],  $test_player3);

        return $app['twig']->render('init.html.twig', array('players' => Player::getAllPCs(), 'enemies' => Player::getAllEnemies(), 'order' => $_SESSION['order_of_init']));
    });

    $app->post("/deleteEnemy/{id}", function($id) use ($app) {
        Player::deleteEnemy($id);
        $current_player_turn = $_SESSION['order_of_init'][0]->getName();
        //echo($current_player_turn->getName());
        $_SESSION['order_of_init'] = Player::orderAllByInit();
        if ($_SESSION['order_of_init'][0]->getName == $current_player_turn)

        //$users = User::getAll();
        return $app['twig']->render('redirect.html.twig');
    });


    return $app;
?>
