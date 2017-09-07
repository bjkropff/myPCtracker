<?php
    class Initative
    {
        private $id;
        private $name;



        function __construct($name, $id = null)
        {
            $this->name = $name;
            $this->id = $id;
        }

        static function deleteAll()
        {
            $executed = $GLOBALS['DB']->exec("DELETE FROM initative;");
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

    }
?>
