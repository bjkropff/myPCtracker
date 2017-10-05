  <?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    // require_once "src/Player.php";
    require_once __DIR__."/../src/Player.php";


    //MySQL database info changing to seetings.php outside of the docroot
    // Orginal
    // $server = 'mysql:host=(localhost or 127 or host ip):(port);dbname=(name))';
    // $username = 'root';

    $server = 'mysql:host=localhost:33067;dbname=test_player';
    $username = 'root';
    $password = '';

    // This works with the app.php but not PHPunit testing
    // require_once __DIR__."/../../settings.php";
    //
    // $server = 'mysql:host=' .
    //     $settings['host'] . ':' .
    //     $settings['port'] . ';dbname=' .
    //     $settings['testdb'];
    // $username = $settings['username'];
    // $password = $settings['password'];


    $DB = new PDO($server, $username, $password);


    class PlayerTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Player::deleteAll();
        }

        //Name get and set
        function test_getName()
        {
            //Arrange
            $name = "Tonka";
            $hp = 15;
            // $mail = "player@place.com";
            $init = 11;
            $ac = 10;
            // $picture = "myimage.jpg";
            $test_player = new Player($name, $hp, $ac, $init);
            //Act
            $result = $test_player->getName();
            //Assert
            $this->assertEquals($name, $result);
            // echo("Name get \n");
        }

        function test_setName()
        {
            //Arrange
            $name = "Karrik";
            $hp = 15;
            // $mail = "player@place.com";
            $ac = 10;
            $init = 11;
            // $picture = "myimage.jpg";
            $test_player = new Player($name, $hp, $ac, $init);

            //Act
            $test_player->setName("George");
            $name = $test_player->getName();
            //Assert
            $this->assertTrue($name == "George");
            // echo("Name set \n");
        }

        //HP get and set
        function test_getHP()
        {
            //Arrange
            $name = "Karrik";
            $hp = 9;
            // $mail = "player@place.com";
            $init = 11;
            $ac = 10;
            // $picture = "myimage.jpg";
            $test_player = new Player($name, $hp, $ac, $init);

            //Act
            $result = $test_player->getHp();
            //Assert
            $this->assertEquals($hp, $result);
            //  echo("Name get \n");
        }

        function test_setHP()
        {
            //Arrange
            $name = "LL";
            $hp = 15;
            // $mail = "player@place.com";
            $init = 11;
            $ac = 10;
            // $picture = "myimage.jpg";
            $test_player = new Player($name, $hp, $ac, $init);
            //Act
            $test_player->setHp(21);
            $healing = $test_player->getHp();
            //Assert
            $this->assertTrue($healing == 21);
            // echo("Name set \n");
        }

        function test_getAC()
        {
            //Arrange
            $name = "Karrik";
            $hp = 9;
            // $mail = "player@place.com";
            $init = 11;
            $ac = 10;
            // $picture = "myimage.jpg";
            $test_player = new Player($name, $hp, $ac, $init);

            //Act
            $result = $test_player->getAc();
            //Assert
            $this->assertEquals($ac, $result);
            //  echo("Name get \n");
        }

        function test_setAC()
        {
            //Arrange
            $name = "LL";
            $hp = 15;
            // $mail = "player@place.com";
            $init = 11;
            $ac = 10;
            // $picture = "myimage.jpg";
            $test_player = new Player($name, $hp, $ac, $init);
            //Act
            $test_player->setAc(21);
            $healing = $test_player->getAc();
            //Assert
            $this->assertTrue($healing == 21);
            // echo("Name set \n");
        }



        function test_save()
        {
            //Arrange
            $name = "LL";
            $hp = 15;
            $init = 21;
            $ac = 1;
            $test_player1 = new Player($name, $hp, $ac, $init);

            $name = "Karrik";
            $hp = 24;
            $init = 11;
            $ac = 0;
            $test_player2 = new Player($name, $hp, $ac, $init);

            //Act
            $isSaved = $test_player1->save();
            $isSaved2 = $test_player2->save();
            if ($isSaved == 0 || $isSaved2 == 0)
            {
                $isSaved == false;
            }

            $isSaved = $isSaved + $isSaved;

            // Assert
             $this->assertTrue(is_numeric($isSaved)&&$isSaved != 0);
        }

        function test_findById()
        {
            //Arrange
            $name = "LL";
            $hp = 15;
            $init = 21;
            $ac = 0;
            $test_player1 = new Player($name, $hp, $ac, $init);

            $name = "Karrik";
            $hp = 24;
            $init = 11;
            $ac = 0;
            $test_player2 = new Player($name, $hp, $ac, $init);

            $test_player1->save();
            $test_player2->save();

            $id = $test_player1->getId();

            //Act
            $playerId = Player::findById($id);

            // Assert
             $this->assertEquals($test_player1, Player::findById($id));
        }

        function test_findByName()
        {
            //Arrange
            $name = "LL";
            $hp = 15;
            $init = 21;
            $ac = 0;
            $test_player1 = new Player($name, $hp, $ac, $init);

            $name = "Karrik";
            $hp = 24;
            $init = 11;
            $ac = 0;
            $test_player2 = new Player($name, $hp, $ac, $init);

            $test_player1->save();
            $test_player2->save();
            $id = $test_player1->getName();

            //Act
            $playerId = Player::findByName($name);

            // Assert
            // assertTrue will return the string if false
            // $this->assertTrue( is_numeric($test_player1->save()));
             $this->assertEquals($test_player2, Player::findByName($name));
        }

        function test_singleGetPlayer()
        {
          //Arrange first
          $name = "Tonka";
          $hp = 12;
          $init = 8;
          $ac = 10;
          $test_player = new Player($name, $hp, $ac, $init);
          $executed = $test_player->save();

          //Arrange second
          $name1 = "Bindi";
          $hp = 28;
          $init = 13;
          $ac = 12;
          $test_player1 = new Player($name, $hp, $ac, $init);
          $executed1 = $test_player1->save();

          //Act
          $result = Player::findByName($name);
          $getname = $test_player->getInit();
          // $getname2 = $result->getName();

          //Assert
          //$this->assertEquals($getname2, "Bindi");
          $this->assertEquals($result, $test_player);
        }

        function test_getAllPlayers()
        {
          //Arrange first
          $name = "Tonka";
          $hp = 12;
          $init = 8;
          $ac = 0;
          $id = 0;
          $test_player = new Player($name, $hp, $ac, $init, $id);
          $executed = $test_player->save();

          //Arrange second
          $name = "Bindi";
          $hp = 28;
          $init = 1;
          $ac = 1;
          $id = 1;
          $test_player1 = new Player($name, $hp, $ac, $init, $id);
          $executed1 = $test_player1->save();

          //Act
          $result = Player::getAllPlayers();

          //Assert
          $this->assertEquals([$test_player, $test_player1], $result);
        }

        function test_updateHp()
        {
          //Arrange first
          $name = "Tonka";
          $hp1 = 12;
          $init = 8;
          $ac = 0;
          $id = 0;
          $test_player = new Player($name, $hp1, $ac, $init, $id);
          $executed = $test_player->save();

          //Arrange second
          $name = "Bindi";
          $hp = 28;
          $init = 1;
          $ac = 1;
          $id = 1;
          $test_player1 = new Player($name, $hp, $ac, $init, $id);
          $executed1 = $test_player1->save();

          //Act
          $new_hp = 25;
          $result = $test_player->updateHp($new_hp, $hp1);

          //Assert
          $this->assertEquals(($new_hp == $test_player->getHp()), $result);
        }

        function test_updateHpPlusMinus()
        {
          //Arrange first
          $name = "Tonka";
          $hp1 = 12;
          $init = 8;
          $ac = 0;
          $id = 0;
          $test_player = new Player($name, $hp1, $ac, $init, $id);
          $executed = $test_player->save();

          //Arrange second
          $name = "Bindi";
          $hp = 28;
          $init = 1;
          $ac = 1;
          $id = 1;
          $test_player1 = new Player($name, $hp, $ac, $init, $id);
          $executed1 = $test_player1->save();

          //Act
          $new_hp = '-5';
          $final_hp = $test_player->getHp() + $new_hp;
          $result = $test_player->updateHp($new_hp, $hp1);

          //Assert
          $this->assertEquals($final_hp, $result);
        }

        function test_orderInit()
        {
        //Arrange first
        $name = "Tonka";
        $hp1 = 12;
        $init = 3;
        $ac = 0;
        $id = 0;
        $test_player = new Player($name, $hp1, $ac, $init, $id);
        $executed = $test_player->save();

        $name = "Bindi";
        $hp = 28;
        $init = 9;
        $ac = 1;
        $id = 1;
        $test_player1 = new Player($name, $hp, $ac, $init, $id);
        $executed1 = $test_player1->save();


        $rolls_array = [
            "Tonka" => 15,
            "Bindi" => 10,
        ];
        // $test_player->save();
        // $test_player1->save();
        // $test_player2->save();
        // $test_player3->save();
        //
        //Act

         $order = Player::orderByInit($rolls_array);

        //Assert
        $this->assertEquals([$order[0]->getName(), $order[1]->getName()],["Tonka", "Bindi"]);
       }



    }
?>
