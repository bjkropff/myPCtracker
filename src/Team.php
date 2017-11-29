<?php
    class Team
    {

        private $name;
        private $id;

        function __construct($name, $id = null)
        {
            $this->name = $name;
            $this->id = $id;
        }

        static function deleteAll()
        {
            $executed = $GLOBALS['DB']->exec("DELETE FROM teamnames;");
            return true;
        }

        //SETS
        function setId($new_id)
        {
          $this->id = (int) $new_id;
        }

        function setName($new_name)
        {
          $this->name = (string) $new_name;
        }

        //GETS
        function getId()
        {
            return $this->id;
        }

        function getName()
        {
            return $this->name;
        }


        function save()
        {
            $thisname = $this->getName();
            // print($thisname);
            // Because this is a name, punctuations break it
            $executed = $GLOBALS['DB']->exec("INSERT INTO teamnames (name) VALUES ('{$this->getName()}');");
            if (!$executed) {
              return "A failure has accured. Did you use a punctuation?";
            }
            $returned_teams = $GLOBALS['DB']->query("SELECT * FROM teamnames WHERE name = '{$this->getName()}';");

            foreach($returned_teams as $team)
            {
                if($thisname == $team['name'])
                {
                  $id = intval($team['id']);
                  $this->setId($id);

                  return $id;
                }
            }
        }

        static function getAllTeams()
        {
            $returned_teams = $GLOBALS['DB']->query("SELECT * FROM teamnames;");

            if (!$returned_teams) {
              return "A failure has accured. Did you use a punctuation?";
            }

            $teams = array();
            foreach($returned_teams as $team)
            {
                $name = $team['name'];
                $id   = intval($team['id']);

                $next_team = new Team($name, $id);


                array_push($teams, $next_team);
            }

            return $teams;
        }

        static function findByTeamname($search_name)
        {
            $returned_teams = $GLOBALS['DB']->query("SELECT * FROM teamnames WHERE name = '{$search_name}'; ");

            foreach($returned_teams as $team)
            {
                $name = $team['name'];
                if ($name == $search_name)
                {
                  $name = $team['name'];
                  $id   = intval($team['id']);

                  $found_team = new Team($name, $id);
                  return $found_team;
                }
            }
        }

        static function findByTeamID($search_id)
        {
            $found_team = null;
            $returned_teams = $GLOBALS['DB']->prepare("SELECT * FROM teamnames WHERE id = :id");
            $returned_teams->bindParam(':id', $search_id, PDO::PARAM_STR);
            $returned_teams->execute();

            if (!$returned_teams) {
              return "A failure has accured. Did you use a punctuation?";
            }

            foreach($returned_teams as $team)
            {
                $id = $team['id'];
                if ($id == $search_id)
                {
                  $name = $team['name'];
                  $id   = intval($team['id']);

                  $found_team = new Team($name, $id);
                  return $found_team;
                }
            }
        }

        static function getAllPlayersOfTeam()
        {
            $returned_teams = $GLOBALS['DB']->query("SELECT * FROM teamnames;");

            if (!$returned_teams) {
              return "A failure has accured. Did you use a punctuation?";
            }

            $teams = array();
            foreach($returned_teams as $team)
            {
                $name = $team['name'];
                $id   = intval($team['id']);

                $next_team = new Team($name, $id);
                array_push($teams, $next_team);
            }

            return $teams;
        }

    }
?>
