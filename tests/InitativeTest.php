<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    // require_once "src/Player.php";
    require_once __DIR__."/../src/Initative.php";


    //MySQL database info changing to seetings.php outside of the docroot
    // Orginal
    // $server = 'mysql:host=(localhost or 127 or host ip):(port);dbname=(name))';
    // $username = 'root';

    $server = 'mysql:host=localhost:33067;dbname=test_player';
    $username = 'root';
    $password = '';

    // require_once __DIR__."/../../settings.php";
    //
    // $server = 'mysql:host=' .
    //     $settings['host'] . ':' .
    //     $settings['port'] . ';dbname=' .
    //     $settings['testdb'];
    // $username = $settings['username'];
    // $password = $settings['password'];
    //
    // $DB = new PDO($server, $username, $password);

    //
    // class InitativeTest extends PHPUnit_Framework_TestCase
    // {
    //     protected function tearDown()
    //     {
    //         // Initative::deleteAll();
        // }


      //   function test_orderInit()
      //   {
      //   //Arrange first
       //
      //   //
      //   $char_id = 1;
       //
      //   $place = 1;
      //   $score = 5;
      //   $id = 1;
      //   $test_player = new Initative($char_id, $order, $score, $id);
       //
      //   //Arrange second
      //   $char_id = 2;
      //   $place = 2;
      //   $score = 4;
      //   $id = 2;
      //   $test_player = new Initative($char_id, $order, $score, $id);
       //
      //   $char_id = 3;
      //   $place = 3;
      //   $score = 3;
      //   $id = 3;
      //   $test_player = new Initative($char_id, $order, $score, $id);
       //
      //   // $test_player->save();
      //   // $test_player1->save();
      //   // $test_player2->save();
      //   // $test_player3->save();
      //   //
      //   //Act
       //
      //   // $order = Initative::orderByInit();
       //
      //   //Assert
      //   $this->assertGreaterThan($order[0], $order[1]);
      //  }
       //
      //   function test_order()
      //   {
      //     //Arrange first
      //     $name = "Tonka";
      //     $hp = 12;
      //     $init = 8;
      //     $ac = 0;
      //     $id = 0;
      //     $test_player = new Player($name, $hp, $ac, $init, $id);
       //
      //     //Arrange second
      //     $name = "Bindi";
      //     $hp = 28;
      //     $init = 1;
      //     $ac = 1;
      //     $id = 1;
      //     $test_player1 = new Player($name, $hp, $ac, $init, $id);
       //
      //     $name = "LL";
      //     $hp = 15;
      //     $init = 21;
      //     $ac = 9;
      //     $test_player2 = new Player($name, $hp, $ac, $init);
       //
      //     $name = "Karrik";
      //     $hp = 24;
      //     $init = 11;
      //     $ac = 7;
      //     $test_player3 = new Player($name, $hp, $ac, $init);
       //
      //     $test_player->save();
      //     $test_player1->save();
      //     $test_player2->save();
      //     $test_player3->save();
       //
      //     //Act
       //
      //     $order = Player::orderByInit();
       //
      //     //Assert
      //     $this->assertGreaterThan($order[0], $order[1]);
        // }
    // }
?>
