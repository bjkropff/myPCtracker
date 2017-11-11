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

    $app->get("/", function() use ($app) {
      $message = '{{message}}';
        return $app['twig']->render('index.html.twig', array('players' => Player::getAllPlayers(), 'message' => $message));
    });

    $app->post("/", function() use ($app) {
        $id = intval($_POST['id']);
        $updatedHp = intval($_POST['hp']);
        $character = Player::findById($id);
        $oldHp =$character->getHp();
        if($oldHp != $updatedHp)
        {
            $character->updateHp($updatedHp, $oldHp);
        }
        return $app['twig']->render('index.html.twig', array('players' => Player::getAllPlayers()));
    });

    $app->get("/character/{name}", function($name) use ($app) {
        $character = Player::findByName($name);
        return $app['twig']->render('character.html.twig', array('player' => $character));
    });

    $app->get("/init", function() use ($app) {
        //$users = User::getAll();
        // $_SESSION['order_of_init'] = array();
        if (empty($_SESSION['order_of_init'])) {
          $_SESSION['order_of_init'] = Player::orderByRoll([0,0,0,0]);
        }

        // $order = $_SESSION['order_of_init'];

        return $app['twig']->render('init.html.twig', array('players' => Player::getAllPlayers(), 'order' => $_SESSION['order_of_init']));
      });

    //Setting up '/add_enemy' coming from the home page
    $app->post("/add_enemy", function() use ($app) {
        $rolls_array = [
            "Bindi" => intval($_POST['init_Bindi']),
            "LL" => intval($_POST['init_LL']),
            "Karrik" => intval($_POST['init_Karrik']),
            "Tonka" => intval($_POST['init_Tonka']),
        ];

        $_SESSION['order_of_init'] = Player::orderWithName($rolls_array);

        return $app['twig']->render('addEnemy.html.twig', array('players' => Player::getAllPlayers(), 'order' => $_SESSION['order_of_init']));
    });

    //Coming from the add_enemy page
    $app->post("/another_enemy", function() use ($app) {

        $name = $_POST['name'];
        $hp = intval($_POST['hp']);
        $init = intval($_POST['init']);
        $ac = intval($_POST['ac']);
        $summary = "";
        $test_player3 = new Player($name, $hp, $ac, $init, $summary, $enemy = 1);
        //$test_player3->save();

        $_SESSION['order_of_init'] = Player::addEnemyToOrder($_SESSION['order_of_init'],  $test_player3);

        return $app['twig']->render('addEnemy.html.twig', array('players' => Player::getAllPlayers(), 'order' => $_SESSION['order_of_init']));
    });

    //Coming from /another_enemy page
    $app->post("/init", function() use ($app) {
        $name = $_POST['enemy_name'];
        $hp = intval($_POST['enemy_hp']);
        $init = intval($_POST['enemy_init']);
        $ac = intval($_POST['enemy_ac']);
        $summary = "";
        $test_player3 = new Player($name, $hp, $ac, $init, $summary, $enemy = 1);
        //$test_player3->save();

        $_SESSION['order_of_init'] = Player::addEnemyToOrder($_SESSION['order_of_init'],  $test_player3);

        return $app['twig']->render('init.html.twig', array('players' => Player::getAllPlayers(), 'order' => $_SESSION['order_of_init']));
    });

    $app->get("/redirect", function() use ($app) {
        //$users = User::getAll();
        $order = $_SESSION['order_of_init'];

        $turn_end = array_shift($order);
        array_push($order, $turn_end);
        $_SESSION['order_of_init'] = $order;
        return $app['twig']->render('redirect.html.twig');
    });

    $app->get("/enemies", function() use ($app) {
        //$users = User::getAll();
        return $app['twig']->render('enemies.html.twig', array('enemies' => Player::getAllPlayers()));
    });

    $app->get("/add_enemy", function() use ($app) {
        //$users = User::getAll();
        return $app['twig']->render('enemies.html.twig', array('enemies' => Player::getAllPlayers()));
    });

    $app->post("/enemies", function() use ($app) {
        //$users = User::getAll();
        return $app['twig']->render('enemies.html.twig', array('enemies' => Player::getAllPlayers()));
    });


    return $app;
?>
