<?php
    class HiddenIP {
        private static $table = "HiddenIPs";
        private $Address;

        public function getAddress () {
            return $this->Address;
        }

        public function INSERT ($db) {
            $query = "INSERT INTO " . self::$table . " (Address) VALUES (?)";

            $db->execute($query, [$this->Address]);
        }

        public static function SELECT ($db, $WHERE = null) { // se não for passado WHERE, é definido como null
            $query = "SELECT Address FROM ". self::$table
            ." $WHERE";

            return $db->execute($query)->fetchAll();
        }

        public function __construct($addressIP) {
            $this->Address = $addressIP;
        }
    }
?>