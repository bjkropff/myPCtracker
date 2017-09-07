<?php
    class Player
    {
        private $name;
        private $hp;
        private $ac;
        private $init;
        private $id;


        function __construct($name, $hp, $ac, $init, $id = null)
        {
            $this->name = $name;
            $this->hp = $hp;
            $this->ac = $ac;
            $this->init = $init;
            $this->id = $id;
        }

        static function deleteAll()
        {
            $executed = $GLOBALS['DB']->exec("DELETE FROM characters;");
            return true;
        }

        //SETS
        function setAc($new_ac)
        {
          $this->ac = (int) $new_ac;
        }

        function setHp($new_hp)
        {
            $this->hp = (int) $new_hp;
        }

        function setId($new_id)
        {
          $this->id = (int) $new_id;
        }

        function setInit($new_init)
        {
            $this->init = (int) $new_init;
        }

        function setName($new_name)
        {
          $this->name = (string) $new_name;
        }

        //GETS
        function getAc()
        {
          return $this->ac;
        }

        function getHp()
        {
          return $this->hp;
        }

        function getId()
        {
            return $this->id;
        }

        function getInit()
        {
          return $this->init;
        }

        function getName()
        {
            return $this->name;
        }

        //OTHER
        function save()
        {
            $thisname = $this->getName();
            $executed = $GLOBALS['DB']->exec("INSERT INTO characters (name, hp, ac, init) VALUES ('{$thisname}', {$this->getHp()}, {$this->getAc()}, {$this->getInit()});");
            $returned_players = $GLOBALS['DB']->query("SELECT * FROM characters WHERE name = '{$thisname}'; ");
            foreach($returned_players as $player)
            {
                if($thisname == $player['name'])
                {
                  $id = intval($player['id']);
                  $this->id = $id;

                  return $id;
                }
            }
        }


        static function findById($search_id)
        {
            $found_player = null;
            $returned_players = $GLOBALS['DB']->prepare("SELECT * FROM characters WHERE id = :id");
            $returned_players->bindParam(':id', $search_id, PDO::PARAM_STR);
            $returned_players->execute();
            foreach($returned_players as $player) {
                $id = $player['id'];
                if ($id == $search_id)
                {
                    $name = $player['name'];
                    $hp = intval($player['hp']);
                    $ac = intval($player['ac']);
                    $init = intval($player['init']);
                    $found_player = new Player($name, $hp, $ac, $init, $id);
                }
            }
            return $found_player;
        }

        static function findByName($search_name)
        {
            $returned_players = $GLOBALS['DB']->query("SELECT * FROM characters WHERE name = '{$search_name}'; ");

            foreach($returned_players as $player)
            {
                $name = $player['name'];
                if ($name == $search_name)
                {
                    $hp = intval($player['hp']);
                    $ac = intval($player['ac']);
                    $init = intval($player['init']);
                    $id = intval($player['id']);
                    $found_player = new Player($name, $hp, $ac, $init, $id);
                    return $found_player;
                }
            }

        }

        static function getAllPlayers()
        {
            $returned_players = $GLOBALS['DB']->query("SELECT * FROM characters;");
            $players = array();
            foreach($returned_players as $player)
            {
                $name = $player['name'];
                $hp   = intval($player['hp']);
                $ac   = intval($player['ac']);
                $init = intval($player['init']);
                $id   = intval($player['id']);

                $next_player = new Player($name, $hp, $ac, $init, $id);

                array_push($players, $next_player);
            }

            return $players;
        }



        function updateHp($new_hp, $old_hp)
        {
            $minus = strpos($new_hp,'-');
            $plus = strpos($new_hp,'+');

            if($minus || $plus)
            {
                $new_hp += $old_hp;
            }

            $executed = $GLOBALS['DB']->exec("UPDATE characters SET hp = {$new_hp} WHERE id = {$this->getId()};");
            if ($executed) {
                $this->setHp($new_hp);
                return true;
            } else {
                return false;
            }
        }

        static function orderByInit()
        {
            $returned_players = Player::getAllPlayers();
            // foreach($returned_players as $player)
            // {
            //
            // }
            usort($returned_players, function($first, $next)
            {
                if ($first->getInit() <= $next->getInit())
                {
                    return 1;
                }
                else
                {
                    return 0;
                }
            });

            return $returned_players;
        }

    }
?>
