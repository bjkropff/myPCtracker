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


    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app->get("/", function() use ($app) {
        //$users = User::getAll();
        return $app['twig']->render('index.html.twig', array('players' => Player::getAllPlayers()));
    });








    return $app;

?>
