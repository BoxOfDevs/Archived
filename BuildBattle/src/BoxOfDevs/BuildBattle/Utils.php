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

use BoxOfDevs\BuildBattle\Vector4;

class Utils {
    public function plotFromString($string) {
        return Vector4::__fromString($string);
    }
    public function plotToString(Vector3 $pos1, Vector3 $pos2) {
        $v = new Vector4($pos1, $pos2);
        return $v->__toString();
    }
}