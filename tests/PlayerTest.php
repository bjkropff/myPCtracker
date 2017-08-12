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


    require_once __DIR__."/../../settings.php";

    $server = 'mysql:host=' .
        $settings['host'] . ':' .
        $settings['port'] . ';dbname=' .
        $settings['testdb'];
    $username = $settings['username'];
    $password = $settings['password'];

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
            // $status = 0;
            // $picture = "myimage.jpg";
            $test_player = new Player($name, $hp, $init
            //   $mail, $status, $picture
            );
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
            $init = 11;
            // $status = 0;
            // $picture = "myimage.jpg";
            $test_player = new Player($name, $hp, $init
            //  , $hp, $mail, $init, $status, $picture
            );
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
            // $status = 0;
            // $picture = "myimage.jpg";
            $test_player = new Player($name, $hp, $init
            //   $mail, $status, $picture
            );
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
            // $status = 0;
            // $picture = "myimage.jpg";
            $test_player = new Player($name, $hp, $init
            //  , $hp, $mail, $init, $status, $picture
            );
            //Act
            $test_player->setHp(21);
            $healing = $test_player->getHp();
            //Assert
            $this->assertTrue($healing == 21);
            // echo("Name set \n");
        }

        function test_getAllPlayers()
        {
            //Arrange first
            $name = "Tonda";
            $hp = 12;
            $mail = "player@place.com";
            $init = 8;
            $status = 0;
            $picture = "myimage.jpg";

            $test_player = new Player($name, $hp, $init);
            $executed = $test_player->save();
            $test_player->setId($executed);

            //Arrange second
            $name0 = "Bindi";
            $hp0 = 82;
            $mail0 = "budd@place.com";
            $init0 = 1;
            $status0 = 1;
            $picture0 = "buddImage.jpg";
            $test_player0 = new Player($name0, $hp0, $init0);
            $executed0 = $test_player0->save();
            //Act


            $result = Player::getAllPlayers();


            //Assert
            $this->assertEquals([$test_player, $test_player0], $result);
        }

        function test_save()
        {
            //Arrange
            $name = "LL";
            $hp = 15;
            $init = 21;
            // $status = 0;
            // $picture = "myimage.jpg";
            $test_player1 = new Player($name, $hp, $init
            //, , $status, $picture
            );

            $name = "Karrik";
            $hp = 24;
            $init = 11;
            // $status = 0;
            // $picture = "myimage.jpg";
            $test_player2 = new Player($name, $hp, $init
            //, , $status, $picture
            );

            $test_player1->save();
            $test_player2->save();

            //Act
            $playerId = $test_player1->getId();

            // Assert
            // assertTrue will return the string if false
            // $this->assertTrue( is_numeric($test_player1->save()));
             $this->assertEquals($playerId, $test_player1->getId());
        }

        // function test_getPass()
        // {
        //     //Arrange
        //     $name = "Fred";
        //     $hp = "1a2b3c";
        //     $mail = "player@place.com";
        //     $init = 0;
        //     $status = 0;
        //     $picture = "myimage.jpg";
        //     $test_player = new Player($name, $hp, $mail, $init, $status, $picture);
        //     //Act
        //     $result = $test_player->getPass();
        //     //Assert
        //     $this->assertEquals($hp, $result);
        // }
        //
        // function test_setPass()
        // {
        //     //Arrange
        //     $name = "Fred";
        //     $hp = "1a2b3c";
        //     $mail = "player@place.com";
        //     $init = 0;
        //     $status = 0;
        //     $picture = "myimage.jpg";
        //     $test_player = new Player($name, $hp, $mail, $init, $status, $picture);
        //     //Act
        //     $test_player->setPass("dragon");
        //     $hp = $test_player->getPass();
        //     //Assert
        //     $this->assertTrue($hp == "dragon");
        // }
        //
        // function test_getMail()
        // {
        //     //Arrange
        //     $name = "Fred";
        //     $hp = "1a2b3c";
        //     $mail = "player@place.com";
        //     $init = 0;
        //     $status = 0;
        //     $picture = "myimage.jpg";
        //     $test_player = new Player($name, $hp, $mail, $init, $status, $picture);
        //     //Act
        //     $result = $test_player->getMail();
        //     //Assert
        //     $this->assertEquals($mail, $result);
        // }
        //
        // function test_setMail()
        // {
        //     //Arrange
        //     $name = "Fred";
        //     $hp = "1a2b3c";
        //     $mail = "player@place.com";
        //     $init = 0;
        //     $status = 0;
        //     $picture = "myimage.jpg";
        //     $test_player = new Player($name, $hp, $mail, $init, $status, $picture);
        //     //Act
        //     $test_player->setMail("george@geosomething.net");
        //     $mail = $test_player->getMail();
        //     //Assert
        //     $this->assertTrue($mail == "george@geosomething.net");
        // }
        //
        // function test_getRole()
        // {
        //     //Arrange
        //     $name = "Fred";
        //     $hp = "1a2b3c";
        //     $mail = "player@place.com";
        //     $init = 0;
        //     $status = 0;
        //     $picture = "myimage.jpg";
        //     $test_player = new Player($name, $hp, $mail, $init, $status, $picture);
        //     //Act
        //     $result = $test_player->getRole();
        //     //Assert
        //     $this->assertEquals($init, $result);
        // }
        //
        // function test_setRole()
        // {
        //     //Arrange
        //     $name = "Fred";
        //     $hp = "1a2b3c";
        //     $mail = "player@place.com";
        //     $init = 0;
        //     $status = 0;
        //     $picture = "myimage.jpg";
        //     $test_player = new Player($name, $hp, $mail, $init, $status, $picture);
        //     $isAdmin = false;
        //     //Act
        //     if (!$isAdmin) {
        //         $test_player->setRole(1);
        //         $isAdmin = true;
        //     }
        //     $init = $test_player->getRole();
        //     //Assert
        //     $this->assertEquals($init, $isAdmin);
        // }
        //
        // function test_getStatus()
        // {
        //     //Arrange
        //     $name = "Fred";
        //     $hp = "1a2b3c";
        //     $mail = "player@place.com";
        //     $init = 0;
        //     $status = 0;
        //     $picture = "myimage.jpg";
        //     $test_player = new Player($name, $hp, $mail, $init, $status, $picture);
        //     //Act
        //     $result = $test_player->getStatus();
        //     //Assert
        //     $this->assertEquals($status, $result);
        // }
        //
        // function test_setStatus()
        // {
        //     //Arrange
        //     $name = "Fred";
        //     $hp = "1a2b3c";
        //     $mail = "player@place.com";
        //     $init = 0;
        //     $status = 0;
        //     $picture = "myimage.jpg";
        //     $test_player = new Player($name, $hp, $mail, $init, $status, $picture);
        //     $isOnline = 0;
        //     //Act
        //     if ($status == 0) {
        //         $isOnline = 1;
        //         $test_player->setStatus(1);
        //     }
        //     $test_player->setStatus(1);
        //     $status = $test_player->getStatus();
        //     //Assert
        //     $this->assertEquals($isOnline, $status);
        // }
        //
        // function test_getPicture()
        // {
        //     //Arrange
        //     $name = "Fred";
        //     $hp = "1a2b3c";
        //     $mail = "player@place.com";
        //     $init = 0;
        //     $status = 0;
        //     $picture = "myimage.jpg";
        //     $test_player = new Player($name, $hp, $mail, $init, $status, $picture);
        //     //Act
        //     $result = $test_player->getPicture();
        //     //Assert
        //     $this->assertEquals($picture, $result);
        // }
        //
        // function test_setPicture()
        // {
        //     //Arrange
        //     $name = "Fred";
        //     $hp = "1a2b3c";
        //     $mail = "player@place.com";
        //     $init = 0;
        //     $status = 0;
        //     $picture = "myimage.jpg";
        //     $test_player = new Player($name, $hp, $mail, $init, $status, $picture);
        //     //Act
        //     $test_player->setPicture("mynewimage.png");
        //     $picture = $test_player->getPicture();
        //     //Assert
        //     $this->assertEquals($picture, "mynewimage.png");
        // }
        //
        //
        // function test_getId()
        // {
        //     //Arrange
        //     $name = "Fred";
        //     $hp = "1a2b3c";
        //     $mail = "player@place.com";
        //     $init = 0;
        //     $status = 0;
        //     $picture = "myimage.jpg";
        //     $test_player = new Player($name, $hp, $mail, $init, $status, $picture);
        //     $test_player->save();
        //     //Act
        //     $result = $test_player->getId();
        //     //Assert
        //     $this->assertTrue(is_numeric($result) && $result !== false);
        // }
        //

        //
        // function test_find()
        // {
        //     //Arrange
        //     $name = "Fred";
        //     $hp = "1a2b3c";
        //     $mail = "player@place.com";
        //     $init = 0;
        //     $status = 0;
        //     $picture = "myimage.jpg";
        //     $test_player = new Player($name, $hp, $mail, $init, $status, $picture);
        //     $test_player->save();
        //     $executed = $test_player;
        //     //Act
        //     $result = Player::find($name, $hp);
        //     //$test_player = "This is the input: Fred 1a2b3c";
        //     //Assert
        //     //$result->getId() is returning null
        //     $this->assertEquals($executed, $result);
        // }


    }
?>
