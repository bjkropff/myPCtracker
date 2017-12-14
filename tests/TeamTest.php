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
    require_once __DIR__."/../../settings_local.php";


    $server = 'mysql:host=' .
        $settings['host'] . ':' .
        $settings['port'] . ';dbname=' .
        $settings['testdb'];
    $username = $settings['username'];
    $password = $settings['password'];


    $DB = new PDO($server, $username, $password);

    class TeamTest extends TestCase
    {
        protected function tearDown()
        {
            Team::deleteAll();
        }


        function test_getName()
        {
            //Arrange
            $name = "Goofball's Club";
            $test_team = new Team($name);
            //Act
            $result = $test_team->getName();
            //Assert
            $this->assertEquals("Goofball's Club", $result);
            // echo("Name get \n");
        }

        function test_setName()
        {
            //Arrange
            $name = "Goofball's Club";
            $test_team = new Team($name);
            //Act
            $result = $test_team->setName("Gorge");
            $get = $test_team->getName();

            //Assert
            $this->assertEquals("Gorge", $get);
        }

        function test_save()
        {
          //Arrange
          $name = "Goofball";
          $test_team = new Team($name);
          //Act
          $result = $test_team->save();
          $get = $test_team->getId();

          // sprint($result);
          //Assert
          $this->assertTrue( is_numeric($result) && $result != 0);
        }

        function test_getId()
        {
            //Arrange
            $name = "Goofball";
            $test_team = new Team($name);
            //Act
            $result = $test_team->save();
            $get = $test_team->getId();
            //Assert
            $this->assertEquals($get, $result);
        }

        function test_getAllTeams()
        {
            //Arrange
            $name = "Goofball";
            $test_team = new Team($name);

            $name = "CoolKids";
            $test_team2 = new Team($name);
            //Act
            $result = $test_team->save();

            $result2 = $test_team2->save();

            $arrayOfTeams = Team::getAllTeams();
            //Assert
            $this->assertEquals($arrayOfTeams, [$arrayOfTeams[0], $arrayOfTeams[1]]);
        }

        function test_findById()
        {
            //Arrange
            $name = "Goofball";
            $test_team = new Team($name);

            $name2 = "CoolKids";
            $test_team2 = new Team($name2);
            //Act
            $result = $test_team->save();

            $result2 = $test_team2->save();

            $id = $test_team->getId();

            //Act
            $team_id = Team::findByTeamID($id);

            // Assert
             $this->assertEquals($test_team, $team_id);
        }

        function test_findByteamname()
        {
            //Arrange
            $name = "Goofball";
            $test_team = new Team($name);

            $name2 = "CoolKids";
            $test_team2 = new Team($name2);
            //Act
            $result = $test_team->save();

            $result2 = $test_team2->save();

            $id = $test_team->getId();

            //Act
            $teamname2 = Team::findByTeamname($name2);

            // Assert
            // assertTrue will return the string if false
            // $this->assertTrue( is_numeric($test_player1->save()));
             $this->assertEquals($test_team2, $teamname2);
        }

        // function test_getAllOnSameTeam()
        // {
        //     //Arrange
        //     $name = "Goofball";
        //     $test_team = new Team($name);
        //
        //     $name2 = "CoolKids";
        //     $test_team2 = new Team($name2);
        //
        //     $name3 = "Late to the party";
        //     $test_team3 = new Team($name3);
        //
        //     $name4 = "Late to the party";
        //     $test_team4 = new Team($name4);
        //     //Act
        //     $result = $test_team->save();
        //     $result2 = $test_team2->save();
        //     $result3 = $test_team3->save();
        //     $result4 = $test_team4->save();
        //
        //     //Act
        //     $onteamone = Team::getAllOnSameTeam();
        //
        //     // Assert
        //     // assertTrue will return the string if false
        //     // $this->assertTrue( is_numeric($test_player1->save()));
        //      $this->assertEquals(count($onteamone), 2);
        // }


    }
?>
