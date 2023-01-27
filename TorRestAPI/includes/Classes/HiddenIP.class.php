<?php
    class HiddenIP {
        private static $table = "HiddenIPs";
        private $Address;

        public function validateHideIP () {
            // validates if the input is an IP
            $this->Address = filter_var($this->getAddress(), FILTER_VALIDATE_IP);

            if($this->Address == null)
                $errorMessage = "IP inválido!!";
            else {
                if(count(HiddenIP::SELECT(new Database(), "WHERE Address = '".$this->getAddress()."'")))
                    $errorMessage = "IP já ocultado!!";
            
                if(!isset($errorMessage)) {
                    $valid = false;

                    // check if the IP is in onion IPs
                    foreach(API::getOnionIPs() as $onionIP) {
                        if($onionIP == $this->getAddress()) {
                            $valid = true;
                            break;
                        }
                    }

                    if(!$valid) { // check if the IP is in dan Me IPs
                        foreach(API::getDanMeIPs("../")->Addresses as $danMeIP) {
                            if($danMeIP == $this->getAddress()) {
                                $valid = true;
                                break;
                            }
                        }
                    }

                    if(!$valid)
                        $errorMessage = "IP não existente nas fontes externas!";
                }
            }

            if(isset($errorMessage))
                return $errorMessage;
            else
                return true;
        }

        public function validateUnhideIP () {
            $this->Address = filter_var($this->getAddress(), FILTER_VALIDATE_IP);

            if($this->Address == null)
                return "IP inválido!!";
            else {
                if(!count(HiddenIP::SELECT(new Database(), "WHERE Address = '".$this->getAddress()."'")))
                    return "IP não oculto!";
                else
                    return true;
            }
        }

        public function INSERT ($db) {
            $query = "INSERT INTO " . self::$table . " (Address) VALUES (?)";

            return $db->execute($query, [$this->Address]);
        }

        // if WHERE is not passed, it's set as null
        public static function SELECT ($db, $WHERE = null) {
            $query = "SELECT Address FROM ". self::$table
            ." $WHERE";

            return $db->execute($query)->fetchAll();
        }

        public function DELETE ($db) {
            $query = "DELETE FROM ".self::$table." WHERE Address = ?";

            return $db->execute($query, [$this->Address]);
        }

        public function getAddress () {
            return $this->Address;
        }

        public function __construct($addressIP) {
            $this->Address = $addressIP;
        }
    }
?>