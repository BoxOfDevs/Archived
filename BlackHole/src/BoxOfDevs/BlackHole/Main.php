<?php

namespace BoxOfDevs\BlackHoles;

use pocketmine\Player;
use pocketmine\math\Vector3;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
Use pocketmine\command\Command;
Use pocketmine\command\CommandSender;

class Main extends PluginBase implements Listener{
  public function onEnable(){
    $this->getLogger()->info("§aTest by LittleBigMC loaded.");
    $this->getServer()->getPluginManager()->registerEvents($this, $this);
	    }
        public function onCommand(CommandSender $runner, Command $call, $alia, array $arg){
       switch(strtolower($call->getName())){
            case 'blackhole':
$player = $runner;
$target2 = new Vector3($player->getX(), $player->getY(), $player->getZ());
 $target = new Vector3($this->getConfig()->get("X"), $this->getConfig()->get("Y"), $this->getConfig()->get("Z"));
            If($args[0] === "suck"){
  $player->setMotion($target->subtract($player)->normalize()->multiply(2));
   }
       If($args[0] === "nosuck"){
 $player->setMotion($target2->subtract($player)->normalize()->multiply(2));  
  }
 }
}
}
