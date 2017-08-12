<?php
    class Player
    {
        private $name;
        private $id;
        // private $character;
        // private $ac;
        private $init;
        private $hp;


        function __construct($name, $hp, $init, $id = null)
        {
            $this->name = $name;
            $this->id = $id;
            // $this->character = $character;
            // $this->ac = $ac;
            $this->init = $init;
            $this->hp = $hp;
        }

        static function deleteAll()
        {
            $executed = $GLOBALS['DB']->exec("DELETE FROM characters;");
            if ($executed) {
                return true;
            } else {
                return false;
            }
        }

        function setId($new_id)
        {
            $this->id = (int) $new_id;
        }

        function setName($new_name)
        {
            $this->name = (string) $new_name;
        }

        function setHp($new_hp)
        {
            $this->hp = (int) $new_hp;
        }

        function setInit($new_init)
        {
            $this->init = (int) $new_init;
        }

        function getId()
        {
            return $this->id;
        }

        function getName()
        {
            return $this->name;
        }

        function getHp()
        {
            return $this->hp;
        }

        function getInit()
        {
            return $this->init;
        }

        function save()
        {

            $thisname = $this->getName();
            $executed = $GLOBALS['DB']->exec("INSERT INTO characters (name, hp, init) VALUES ('{$this->getName()}', '{$this->getHp()}', '{$this->getInit()}');");
            $sql = $GLOBALS['DB']->query("SELECT * FROM characters WHERE name = '{$this->getName()}'; ");
            $id = 'duck';
            foreach($sql as $player) {
                $id = intval($player['id']);
                $this->id = $id;
              }
            // $returned_players_id = $GLOBALS['DB']->query("SELECT id FROM characters WHERE name = '{$this->getName()}' ;");
            // $this->id = $returned_players_id;
            return $id;
        }

        static function getAllPlayers()
        {
            $returned_players = $GLOBALS['DB']->query("SELECT * FROM characters;");
            $players = array();
            foreach($returned_players as $player) {
                $name = $player['name'];
                $id = intval($player['id']);
                $init = intval($player['init']);
                $hp = intval($player['hp']);
                $new_player = new Player($name, $hp, $init, $id);
                array_push($players, $new_player);
            }
            return $players;
        }

    }
?>
