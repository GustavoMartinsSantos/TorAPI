<?php
    class Database {
        private static $server = "mysql"; // container name
        private static $db     = "Tor_IPsDB";
        private static $user   = "App_User";
        private static $passwd = "V&4Dp5C1TW78J";
        private $connection;

        public function execute ($query, $values = []) {
            try { // executes all database operations except SELECT
                $stmt = $this->getConnection()->prepare($query);
                $stmt->execute($values);

                return $stmt;
            } catch(PDOException $error) {
                echo $query;
                die('<br>Error: ' . $error->getMessage());
            }
        }

        public function getConnection () {
            return $this->connection;
        }

        private function setConnection () {
            $this->connection = new PDO("mysql:host=".self::$server.";dbname=".self::$db, $this::$user, $this::$passwd);
        }

        public function __construct() {
            $this->setConnection();
        }
    }
?>