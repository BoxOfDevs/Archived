<?php

namespace BoxOfDevs\RealVanish;

use pocketmine\plugin\PluginBase;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\Server;
use pocketmine\Player;
use pocketmine\utils\TextFormat as C;
use pocketmine\network\protocol\DisconnectPacket;


class Main extends PluginBase{
public function onEnable(){
	$this->getLogger()->info(C::GRAY. "Starting....");
 }
 
public function onLoad(){
	$this->getLogger()->info(C::GREEN. "You can now use /vanish");
}

 public function onCommand(CommandSender $sender, Command $cmd, $label, array $args){
switch($cmd->getName()){
	case "vanish":
	$this->getServer()->removeOnlinePlayer($sender);
	$this->getServer()->removePlayer($sender);
	foreach($this->getServer()->getOnlinePlayers() as $player){
		if($player->canSee($sender)){
			$player->hidePlayer($sender);
		}
	}
	$event = $this->getServer()->getPluginManager()->callEvent(new \pocketmine\event\player\PlayerQuitEvent($sender, $sender->getLeaveMessage()));
	$this->getServer()->broadcastMessage($event->getQuitMessage());
	unset($sender->buffer);
	$sender->sendMessage(C::BLUE. "You are now Vanished!");
	return true;
	break;
	case "unvanish":
	$pk = new DisconnectPacket();
	$pk->message = C::YELLOW . "Re-log to unvanish!";
	$sender->directDataPacket($pk);
	return true;
	break;
}
return false;
}
