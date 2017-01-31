<?php
#
#
# //=====\\      ||\\     ||     ||         //\\     ||\\     ||    //======
#||       ||     || \\    ||     ||         \\//     || \\    ||    ||
#||       ||     ||  \\   ||     ||          ||      ||  \\   ||    ||______
#||       ||     ||   \\  ||     ||          ||      ||   \\  ||    ||------
#||       ||     ||    \\ ||     ||          ||      ||    \\ ||    ||
# \\=====//      ||     \\||     \\=====     ||      ||     \\||    \\======
#
# Make websites better and easilier !
#
# Author: BoxOfDevs Team
# Authors: Ad5001
#
# Website: http://boxofdevs.byethost14.com
namespace online;
require_once("Exeptions\NotFound.php");

class JSONConfig {
    public function __construct($path) {
        if(file_exists($path)) {
            $this->cfg = json_decode(preg_replace("#^([ ]*)([a-zA-Z_]{1}[ ]*)\\:$#m", "$1\"$2\":", file_get_contents($path)), true);
        } else {
            throw new \online\Exeptions\NotFound("File on path {$path} does NOT exists !");
        }
    }
    public function get($k) {
        if(!isset($this->cfg[$k])) {
            return  null;
        } else {
            return $this->cfg[$k];
        }
    }
    public function exists($k) {
        return isset($this->config[$k]);
	}
	public function remove($k) {
		unset($this->config[$k]);
	}
    public function save() {
        file_put_contents($path, json_encode($this->config));
    }
}