<?php

    date_default_timezone_set('America/Los_Angeles');
    require_once __DIR__."/../vendor/autoload.php";

    //Class constructors
    require_once __DIR__."/../src/Player.php";

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

    $app['debug'] = true;

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app->get("/", function() use ($app) {
        //$users = User::getAll();
        return $app['twig']->render('index.html.twig', array('players' => Player::getAllPlayers()));
    });

    $app->get("/{name}", function($name) use ($app) {
        $character = Player::findByName($name);
        return $app['twig']->render('character.html.twig', array('player' => $character));
    });

    $app->get("/init", function() use ($app) {
        //$users = User::getAll();
        return $app['twig']->render('init.html.twig', array('players' => Player::orderByInit()));
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

    $app->patch("/init", function() use ($app) {
        $addTonka = intval($_POST['init_Tonka']);
        $addLL = intval($_POST['init_LL']);
        $addBindi = intval($_POST['init_Bindi']);
        $addKarrik = intval($_POST['init_Karrik']);


        // $characters = Player::getAllPlayers();
        // foreach($characters as $char)
        // {
        //
        // }
        return $app['twig']->render('init.html.twig', array('players' => Player::orderByInit()));
    });

    $app->post("/init", function() use ($app) {
        $addTonka = intval($_POST['init_Tonka']);
        $addLL = intval($_POST['init_LL']);
        $addBindi = intval($_POST['init_Bindi']);
        $addKarrik = intval($_POST['init_Karrik']);

        $characters = Player::getAllPlayers();
        foreach($characters as $char)
        {

        }
        return $app['twig']->render('init.html.twig', array('players' => Player::orderByInit()));
    });

    $app->get("/redirect", function() use ($app) {
        //$users = User::getAll();
        return $app['twig']->render('redirect.html.twig');
    });

    $app->post("/redirect", function() use ($app) {
        // $character = Player::findByName($name);
        // $updatedHp = intval($_POST['hp']);
        // if($character->getHp() != $updatedHp)
        // {
        //     $character->update($updatedHp);
        // }
        return $app['twig']->render('redirect.html.twig');
    });

    // $app->get("/categories/{id}/edit", function($id) use ($app) {
    //     $category = Category::find($id);
    //     return $app['twig']->render('category_edit.html.twig', array('category' => $category, 'tasks' => $category->getTasks(), 'all_tasks' => Task::getAll()));
    // });

    return $app;
?>
