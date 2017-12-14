  <?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    // require_once "src/Player.php";
    use PHPUnit\Framework\TestCase;

    require_once __DIR__."/../src/Player.php";
    require_once __DIR__."/../src/Team.php";


    //MySQL database info changing to seetings.php outside of the docroot
    // Orginal
    // $server = 'mysql:host=(localhost or 127 or host ip):(port);dbname=(name))';
    // $username = 'root';

    // You only need the following for one of the test pages
    // require_once __DIR__."/../../settings_local.php";
    //
    //
    // $server = 'mysql:host=' .
    //     $settings['host'] . ':' .
    //     $settings['port'] . ';dbname=' .
    //     $settings['testdb'];
    // $username = $settings['username'];
    // $password = $settings['password'];
    //
    //
    // $DB = new PDO($server, $username, $password);

    class PlayerTest extends TestCase
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
            $summary = "myimage.jpg";
            $id_team = 1;
            $enemy = 0;
            $test_player = new Player($name, $hp, $ac, $init, $summary ="", $enemy, $id_team);
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
            $summary = "myimage.jpg";
            $id_team = 1;
            $enemy = 0;
            $test_player = new Player($name, $hp, $ac, $init, $summary, $enemy, $id_team);

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
            $summary = "myimage.jpg";
            $id_team = 1;
            $enemy = 0;
            $test_player = new Player($name, $hp, $ac, $init, $summary, $enemy, $id_team);

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
            $summary = "myimage.jpg";
            $id_team = 1;
            $enemy = 0;
            $test_player = new Player($name, $hp, $ac, $init, $summary, $enemy, $id_team);
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
            $summary = "myimage.jpg";
            $id_team = 1;
            $enemy = 0;
            $test_player = new Player($name, $hp, $ac, $init, $summary, $enemy, $id_team);

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
            $summary = "myimage.jpg";
            $id_team = 1;
            $enemy = 0;
            $test_player = new Player($name, $hp, $ac, $init, $summary, $enemy, $id_team);
            //Act
            $test_player->setAc(21);
            $healing = $test_player->getAc();
            //Assert
            $this->assertTrue($healing == 21);
            // echo("Name set \n");
        }

        function test_getSummary()
        {
            //Arrange
            $name = "LL";
            $hp = 15;
            // $mail = "player@place.com";
            $init = 11;
            $ac = 10;
            $summary = "myimage.jpg";
            $id_team = 1;
            $enemy = 0;
            $test_player = new Player($name, $hp, $ac, $init, $summary, $enemy, $id_team);
            //Act
            $healing = $test_player->getSummary();
            //Assert
            $this->assertEquals($healing, $summary);
            // echo("Name set \n");
        }

        function test_setSummary()
        {
          //Arrange
          $name = "LL";
          $hp = 15;
          // $mail = "player@place.com";
          $init = 11;
          $ac = 10;
          $summary = "myimage.jpg";
          $id_team = 1;
          $enemy = 0;
          $test_player = new Player($name, $hp, $ac, $init, $summary, $enemy, $id_team);
          //Act
          $test_player->setSummary("21");
          $healing = $test_player->getSummary();
          //Assert
          $this->assertEquals($healing, "21");
          // echo("Name set \n");
        }

        function test_getIsNotEnemy()
        {
            //Arrange
            $name = "LL";
            $hp = 15;
            // $mail = "player@place.com";
            $init = 11;
            $ac = 10;
            $summary = "myimage.jpg";
            $id_team = 1;

            //Act
            $enemy = 0;
            $test_player = new Player($name, $hp, $ac, $init, $summary, $enemy, $id_team);

            //Assert
            $this->assertEquals($test_player->getEnemy(), false);
            // echo("Name set \n");
        }

        function test_getIsEnemy()
        {
            //Arrange
            $name = "LL";
            $hp = 15;
            // $mail = "player@place.com";
            $init = 11;
            $ac = 10;
            $summary = "myimage.jpg";
            $enemy = 1;
            //Act
            $id_team = 1;
            $test_player = new Player($name, $hp, $ac, $init, $summary, $enemy, $id_team);

            //Assert
            $this->assertEquals($test_player->getEnemy(), true);
            // echo("Name set \n");
        }

        function test_setIsNotEnemy()
        {
            //Arrange
            $name = "LL";
            $hp = 15;
            // $mail = "player@place.com";
            $init = 11;
            $ac = 10;
            $summary = "myimage.jpg";

            //Act
            $enemy = 0;
            $id_team = 1;
            $test_player = new Player($name, $hp, $ac, $init, $summary, $enemy, $id_team);

            //Assert
            $this->assertEquals($test_player->getEnemy(), false);
            // echo("Name set \n");
        }

        function test_setIsEnemy()
        {
            //Arrange
            $name = "LL";
            $hp = 15;
            // $mail = "player@place.com";
            $init = 11;
            $ac = 10;
            $summary = "myimage.jpg";
            $enemy = 1;

            //Act
            $id_team = 1;
            $test_player = new Player($name, $hp, $ac, $init, $summary, $enemy, $id_team);

            //Assert
            $this->assertEquals($test_player->getEnemy(), true);
            // echo("Name set \n");
        }

        function test_save()
        {
            //Arrange
            $name = "LL";
            $hp = 15;
            $init = 21;
            $ac = 1;
            $summary = "myimage.jpg";
            $test_player1 = new Player($name, $hp, $ac, $init, $summary);

            $name = "Karrik";
            $hp = 24;
            $init = 11;
            $ac = 0;
            $summary = "myimage.jpg";
            $enemy = 1;
            $id_team = 1;
            $test_player2 = new Player($name, $hp, $ac, $init, $summary, $enemy, $id_team);

            //Act
            $isSaved = $test_player1->save();
            $isSaved2 = $test_player2->save();
            if ($isSaved == 0 || $isSaved2 == 0)
            {
                $isSaved == false;
            }

            //$isSaved = $isSaved + $isSaved;
            // Assert
            //$this->assertEquals($test_player2, $isSaved2 != null);
            $this->assertTrue(is_numeric($isSaved)&&$isSaved != null);
        }

        function test_findById()
        {
            //Arrange
            $name = "LL";
            $hp = 15;
            $init = 21;
            $ac = 0;
            $summary = "myimage.jpg";
            $test_player1 = new Player($name, $hp, $ac, $init, $summary);

            $name = "Karrik";
            $hp = 24;
            $init = 11;
            $ac = 0;
            $summary = "myimage.jpg";
            $test_player2 = new Player($name, $hp, $ac, $init, $summary);

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
            $summary = "myimage.jpg";
            $test_player1 = new Player($name, $hp, $ac, $init, $summary);

            $name = "Karrik";
            $hp = 24;
            $init = 11;
            $ac = 0;
            $summary = "myimage.jpg";
            $test_player2 = new Player($name, $hp, $ac, $init, $summary);

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
          $summary = "myimage.jpg";
          $test_player = new Player($name, $hp, $ac, $init, $summary);
          $executed = $test_player->save();

          //Arrange second
          $name1 = "Bindi";
          $hp = 28;
          $init = 13;
          $ac = 12;
          $summary = "myimage.jpg";
          $test_player1 = new Player($name, $hp, $ac, $init, $summary);
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
          $summary = "myimage.jpg";
          $test_player = new Player($name, $hp, $ac, $init, $summary);
          $executed = $test_player->save();

          //Arrange second
          $name = "Bindi";
          $hp = 28;
          $init = 1;
          $ac = 1;
          $id = 1;
          $summary = "myimage.jpg";
          $test_player1 = new Player($name, $hp, $ac, $init, $summary);
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
          $summary = "myimage.jpg";
          $test_player = new Player($name, $hp1, $ac, $init, $summary);
          $executed = $test_player->save();

          //Arrange second
          $name = "Bindi";
          $hp = 28;
          $init = 1;
          $ac = 1;
          $id = 1;
          $summary = "myimage.jpg";
          $test_player1 = new Player($name, $hp, $ac, $init, $summary);
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
          $summary = "myimage.jpg";
          $test_player = new Player($name, $hp1, $ac, $init, $summary);
          $executed = $test_player->save();

          //Arrange second
          $name = "Bindi";
          $hp = 28;
          $init = 1;
          $ac = 1;
          $id = 1;
          $summary = "myimage.jpg";
          $test_player1 = new Player($name, $hp, $ac, $init, $summary);
          $executed1 = $test_player1->save();

          //Act
          $new_hp = '-5';
          $final_hp = $test_player->getHp() + $new_hp;
          $result = $test_player->updateHp($new_hp, $hp1);

          //Assert
          $this->assertEquals($final_hp, $result);
        }

        function test_orderAllByInit()
        {
        //Arrange first
        $name = "Tonka";
        $hp1 = 12;
        $init = 3;
        $ac = 0;
        $id = 0;
        $summary = "myimage.jpg";
        $test_player = new Player($name, $hp1, $ac, $init, $summary);
        $executed = $test_player->save();
        // print($executed);

        $name = "Bindi";
        $hp = 28;
        $init = 9;
        $ac = 1;
        $id = 1;
        $summary = "myimage.jpg";
        $test_player1 = new Player($name, $hp, $ac, $init, $summary);
        $executed1 = $test_player1->save();
        // print($executed1);


        $name = "Karrik";
        $hp = 28;
        $init = 5;
        $ac = 1;
        $id = 1;
        $summary = "myimage.jpg";
        $test_player2 = new Player($name, $hp, $ac, $init, $summary);
        $executed2 = $test_player2->save();
        // print($executed2);

        $name = "Dragon";
        $hp = 28;
        $init = 7;
        $ac = 1;
        $enemy = 1;
        $summary = "myimage.jpg";
        $test_player3 = new Player($name, $hp, $ac, $init, $summary, $enemy );
        $executed1 = $test_player3->save();

        //Act
          $order_array = array();
          $order = Player::orderAllByInit();
          //print($order);

          foreach( $order as $single_player)
          {
            array_push($order_array, $single_player->getName());
          }

          // print($order_array[0]);

        //Assert
        $this->assertEquals(["Bindi", "Dragon", 'Karrik', "Tonka"], $order_array);
       }

        function test_orderWithPCName()
        {
        //Arrange first
        $name = "Tonka";
        $hp1 = 12;
        $init = 3;
        $ac = 0;
        $id = 0;
        $summary = "myimage.jpg";
        $test_player = new Player($name, $hp1, $ac, $init, $summary);
        $executed = $test_player->save();
        // print($executed);

        $name = "Bindi";
        $hp = 28;
        $init = 9;
        $ac = 1;
        $id = 1;
        $summary = "myimage.jpg";
        $test_player1 = new Player($name, $hp, $ac, $init, $summary);
        $executed1 = $test_player1->save();
        // print($executed1);


        $name = "Karrik";
        $hp = 28;
        $init = 9;
        $ac = 1;
        $id = 1;
        $summary = "myimage.jpg";
        $test_player2 = new Player($name, $hp, $ac, $init, $summary);
        $executed2 = $test_player2->save();
        // print($executed2);

        $rolls_array = [
            "Tonka" => 15,
            "Karrik" => 25,
            "Bindi" => 10,
        ];

        //Act
          $order_array = array();

          // $order = Player::getAllPCs();

          $order = Player::orderWithPCName($rolls_array);
          //print($order);

          foreach( $order as $single_player)
          {
            array_push($order_array, $single_player->getName());
          }

          // print($order_array[0]);

        //Assert
        $this->assertEquals($order_array,['Karrik', "Tonka", "Bindi"]);
       }

       function test_addEnemyToOrder()
       {
       //Arrange first
       $name = "Tonka";
       $hp1 = 12;
       $init = 3;
       $ac = 0;
       $id = 0;
       $summary = "myimage.jpg";
       $test_player = new Player($name, $hp1, $ac, $init, $summary);
       $executed = $test_player->save();

       $name = "Bindi";
       $hp = 28;
       $init = 9;
       $ac = 1;
       $id = 1;
       $summary = "myimage.jpg";
       $test_player1 = new Player($name, $hp, $ac, $init, $summary );
       $executed1 = $test_player1->save();

       $name = "Karrik";
       $hp = 28;
       $init = 9;
       $ac = 1;
       $id = 1;
       $summary = "myimage.jpg";
       $test_player2 = new Player($name, $hp, $ac, $init, $summary );
       $executed1 = $test_player2->save();

       $rolls_array = [
           "Tonka" => 15,
           "Karrik" => 25,
           "Bindi" => 10,
       ];

       $order = Player::orderWithPCName($rolls_array);

       //Act
       $name = "Dragon";
       $hp = 28;
       $init = 9;
       $ac = 1;
       $enemy = 1;
       $summary = "myimage.jpg";
       $test_player3 = new Player($name, $hp, $ac, $init, $summary, $enemy );
       $executed1 = $test_player3->save();

       $order = Player::addEnemyToOrder($order, $test_player3);

       $order_array = array();

       foreach( $order as $single_player)
       {
         array_push($order_array, $single_player->getName());
       }

       //Assert
       $this->assertEquals($order_array,["Karrik", "Tonka", "Bindi", "Dragon"]);
       }

       function test_deleteEnemy()
       {
         //Arrange first
         $name = "Tonka";
         $hp1 = 12;
         $init = 8;
         $ac = 0;
         $id = 0;
         $summary = "myimage.jpg";
         $test_player = new Player($name, $hp1, $ac, $init, $summary);
         $executed = $test_player->save();

         //Arrange second
         $name = "Bindi";
         $hp = 28;
         $init = 1;
         $ac = 1;
         $id = 1;
         $summary = "myimage.jpg";
         $test_player1 = new Player($name, $hp, $ac, $init, $summary);
         $executed1 = $test_player1->save();

         $name = "Dragon";
         $hp = 28;
         $init = 9;
         $ac = 1;
         $id = 1;
         $summary = "myimage.jpg";
         $enemy = 1;
         $id_team = 1;
         $test_player3 = new Player($name, $hp, $ac, $init, $summary, $enemy, $id_team);
         $executed1 = $test_player3->save();

         //Act
         Player::deleteEnemy($test_player3->getId());

         $list_of_players = Player::getAllPlayers();

         //Assert
         $this->assertEquals([$test_player, $test_player1], $list_of_players);
       }

       function test_getAllPCs()
       {
         //Arrange first
         $name = "Tonka";
         $hp = 12;
         $init = 8;
         $ac = 0;
         $id = 0;
         $summary = "myimage.jpg";
         $test_player = new Player($name, $hp, $ac, $init, $summary);
         $executed = $test_player->save();

         //Arrange second
         $name = "Bindi";
         $hp = 28;
         $init = 1;
         $ac = 1;
         $id = 1;
         $summary = "myimage.jpg";
         $enemy = 1;
         $test_player1 = new Player($name, $hp, $ac, $init, $summary, $enemy );
         $executed1 = $test_player1->save();

         //Act
         $result = Player::getAllPCs();
         //print($result[0]->getName());

         //Assert
         $this->assertEquals($test_player, $result[0]);
       }

       function test_removeEnemyFromInit()
       {
         //Arrange first
         $name = "Tonka";
         $hp1 = 12;
         $init = 8;
         $ac = 0;
         $id = 0;
         $summary = "myimage.jpg";
         $test_player = new Player($name, $hp1, $ac, $init, $summary);
         $executed = $test_player->save();

         //Arrange second
         $name = "Bindi";
         $hp = 28;
         $init = 1;
         $ac = 1;
         $id = 1;
         $summary = "myimage.jpg";
         $test_player1 = new Player($name, $hp, $ac, $init, $summary);
         $executed1 = $test_player1->save();

         $name = "Dragon";
         $hp = 28;
         $init = 9;
         $ac = 1;
         $id = 1;
         $summary = "myimage.jpg";
         $enemy = 1;
         $id_team = 1;
         $test_player3 = new Player($name, $hp, $ac, $init, $summary, $enemy, $id_team);
         $executed1 = $test_player3->save();

         //Act
         Player::deleteEnemy($test_player3->getId());

         $list_of_players = Player::getAllPlayers();

         //Assert
         $this->assertEquals([$test_player, $test_player1], $list_of_players);
       }

        function test_getTeamName()
        {
            //Arrange first
            $name = "Tonka";
            $hp1 = 12;
            $init = 8;
            $ac = 0;
            $id = 0;
            $summary = "myimage.jpg";
            $enemey = 0;
            $new_team = "Goofballs";

            $test_team = new Team($new_team);
            $id_team = $test_team->save();

            //Act
            $test_player = new Player($name, $hp1, $ac, $init, $summary, $enemey = 0, $id_team);
            $executed = $test_player->save();

            $team_name = $test_player->getTeamName();
            //print($executed . 1);

            //Assert
            $this->assertEquals($new_team, $team_name);
        }



        function test_allOnSameTeam()
        {
            //Arrange first
            $name = "Goofball";
            $test_team = new Team($name);
            $result = $test_team->save();

            $name2 = "CoolKids";
            $test_team2 = new Team($name2);
            $result2 = $test_team2->save();

            //Arrange second
            $name = "Tonka";
            $hp = 12;
            $init = 8;
            $ac = 0;
            $id = 0;
            $summary = "myimage.jpg";
            $enemy = 0;
            $id_team = $test_team->getId();
            $test_player = new Player($name, $hp, $ac, $init, $summary, $enemy, $id_team);
            $executed = $test_player->save();

            //Arrange second
            $name = "Bindi";
            $hp = 28;
            $init = 1;
            $ac = 1;
            $id = 1;
            $summary = "myimage.jpg";
            $enemy = 0;
            $id_team = $test_team->getId();
            $test_player1 = new Player($name, $hp, $ac, $init, $summary, $enemy, $id_team);
            $executed1 = $test_player1->save();

            $name = "Dragon";
            $hp = 28;
            $init = 9;
            $ac = 1;
            $id = 1;
            $summary = "myimage.jpg";
            $enemy = 1;
            $id_team = $test_team2->getId();
            $test_player3 = new Player($name, $hp, $ac, $init, $summary, $enemy, $id_team);
            $executed2 = $test_player3->save();

            //Act
            $onteamone = Player::getAllOnSameTeam($test_team->getName());

            // Assert
            // assertTrue will return the string if false
            // $this->assertTrue( is_numeric($test_player1->save()));
            $this->assertEquals(count($onteamone), 2);
        }


    }
?>
