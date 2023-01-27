<?php
    class API {
        private $url;

        public function request ($endpoint = null) {
            $uri = $this->url . $endpoint;

            try {
                return @file_get_contents($uri);
            } catch(Exception $error) {
                die($error);
            }
        }

        public static function getDanMeIPs ($jsonFileRoute = null) {
            $API = new API("https://www.dan.me.uk/torlist/");

            $danMeIPs = explode("\n", $API->request());
            array_pop($danMeIPs); // last element always is an empty row
            if($danMeIPs != null) { // if the fetch was done overwrites the JSON file
                $overwriteJSON = '{ "Addresses": [' . "\n".
                '"'.implode('",'."\n".'"', $danMeIPs).'"'."\n] }";
                // "104.53.221.159",\n

                file_put_contents("{$jsonFileRoute}includes/danMeIPs.json", $overwriteJSON);
            }
            
            // always gets the IPs from JSON file
            $danMeIPs = json_decode(file_get_contents("{$jsonFileRoute}includes/danMeIPs.json"));

            return $danMeIPs;
        }

        public static function getOnionIPs () {
            $API = new API("https://onionoo.torproject.org/");
            $onionIPs = array();
            
            foreach(json_decode($API->request("summary?limit=5000"))->relays as $relay) {
                $onionIPs[] = $relay->a[0];
            }

            return $onionIPs;
        }

        public function __construct($url) {
            $this->url = $url;
        }
    }
?>