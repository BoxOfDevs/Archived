<?php
namespace BoxOfDevs\BuildBattle ; 
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\Server;
use pocketmine\utils\Config;
 use pocketmine\Player;
 use pocketmine\math\Vector3;
use pocketmine\level\Level;

class Vector4 {
    public function __construct(Vector3 $pos1, Vector3 $pos2) {
        $this->pos1x = $pos1->x;
        $this->pos1y = $pos1->y;
        $this->pos1z = $pos1->z;
        $this->pos2x = $pos2->x;
        $this->pos2y = $pos2->y;
        $this->pos2z = $pos2->z;
        $this->pos1 = $pos1;
        $this->pos2 = $pos2;
    }
    public function get1() {
        return $this->pos1;
    }
    public function get2() {
        return $this->pos2;
    }
    public function get1X() {
        return $this->pos1x;
    }
    public function get1Y() {
        return $this->pos1y;
    }
    public function get1Z() {
        return $this->pos1z;
    }
    public function get2X() {
        return $this->pos2x;
    }
    public function get2Y() {
        return $this->pos2y;
    }
    public function get2Z() {
        return $this->pos1z;
    }
    public function __toString() {
        return "Vector4(" . $this->pos1x . "-" . $this->pos1y . "-" . $this->pos1z  . "/" . $this->pos2x . "-" . $this->pos2y . "-" . $this->pos2z . "-" .  . ")";
    }
    public static function __fromString($string) {
        $string = str_ireplace("Vector4(", "", $string);
        $string = str_ireplace(")", "", $string);
        $poses = explode("/");
        $pos1 = explode("-",$poses[1]);
        $pos2 = explode("-",$poses[2]);
        return new Vector4(new Vector3($pos1[0], $pos1[1], $pos1[2]), new Vector3($pos2[0], $pos2[1], $pos2[2]));
    }
}